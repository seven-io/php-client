<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Constant\SmsConstants;
use Sms77\Api\Exception\InvalidBooleanOptionException;
use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;
use Sms77\Api\Library\Util;
use Sms77\Api\Params\SmsParamsInterface;

class SmsValidator extends BaseValidator implements ValidatorInterface {
    /* @var SmsParamsInterface $params */
    protected $params;

    public function __construct(SmsParamsInterface $params) {
        $this->params = $params;

        parent::__construct((array)$this->params, [
            'debug',
            'details',
            'flash',
            'json',
            'no_reload',
            'performance_tracking',
            'return_msg_id',
            'unicode',
            'utf8',
        ]);
    }

    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     * @throws InvalidBooleanOptionException
     */
    public function validate(): void {
        $this->delay();
        $this->foreign_id();
        $this->from();
        $this->label();
        $this->text();
        $this->to();
        $this->ttl();

        parent::validate();
    }

    /** @throws InvalidOptionalArgumentException */
    public function delay(): void {
        $delay = $this->params->getDelay();

        if (null === $delay || '' === $delay) {
            return;
        }

        $errorMsg = "Delay must be a valid UNIX timestamp or in the format of "
            . SmsConstants::DELAY_DATE_FORMAT . '.';

        if (false === strpos($delay, '-')) {
            if (!Util::isUnixTimestamp($delay)) {
                throw new InvalidOptionalArgumentException($errorMsg);
            }
        } else if (!preg_match(SmsConstants::DELAY_PATTERN, $delay)) {
            throw new InvalidOptionalArgumentException($errorMsg);
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function foreign_id(): void {
        $foreignId = $this->params->getForeignId();

        if (null === $foreignId || '' === $foreignId) {
            return;
        }

        $maxLength = SmsConstants::FOREIGN_ID_MAX_LENGTH;
        if (mb_strlen($foreignId) > $maxLength) {
            throw new InvalidOptionalArgumentException(
                "foreign_id must not exceed '$maxLength' characters in length.");
        }

        $pattern = SmsConstants::FOREIGN_ID_PATTERN;
        if (strlen($foreignId) !== preg_match_all($pattern, $foreignId)) {
            throw new InvalidOptionalArgumentException(
                "foreign_id must match the regex pattern $pattern");
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function from(): void {
        $from = $this->params->getFrom();

        if (null === $from || '' === $from) {
            return;
        }

        $length = strlen($from);

        $alphaNumericMax = SmsConstants::FROM_ALPHANUMERIC_MAX;
        $numericMax = SmsConstants::FROM_NUMERIC_MAX;

        $isNumeric = is_numeric($from);

        if ($length > $numericMax) {
            throw new InvalidOptionalArgumentException(
                "Argument 'from' may not exceed $numericMax chars.");
        }

        if ($length > $alphaNumericMax && !$isNumeric) {
            throw new InvalidOptionalArgumentException(
                "Argument 'from' must be numeric. if > $alphaNumericMax chars.");
        }

        if (!ctype_alnum(
            str_ireplace(SmsConstants::FROM_ALLOWED_CHARS, '', $from))) {
            throw new InvalidOptionalArgumentException(
                "Argument 'from' must be alphanumeric.");
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function label(): void {
        $label = $this->params->getLabel();

        if (null === $label || '' === $label) {
            return;
        }

        $max = SmsConstants::LABEL_MAX_LENGTH;
        if (mb_strlen($label) > $max) {
            throw new InvalidOptionalArgumentException(
                "label must not exceed '$max' characters in length.");
        }

        $pattern = SmsConstants::LABEL_PATTERN;
        if (strlen($label) !== preg_match_all($pattern, $label)) {
            throw new InvalidOptionalArgumentException(
                "label must match the regex pattern $pattern");
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function text(): void {
        $text = $this->params->getText() ?? '';

        $length = strlen($text);

        if (null === $text || !$length) {
            throw new InvalidRequiredArgumentException(
                'You cannot send an empty message.');
        }

        $maxTextLength = SmsConstants::TEXT_MAX_LENGTH;

        if ($maxTextLength < $length) {
            throw new InvalidRequiredArgumentException(
                "The text can not be longer than $maxTextLength characters.");
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function to(): void {
        $to = $this->params->getTo();

        if (null === $to || '' === $to) {
            throw new InvalidRequiredArgumentException(
                'You cannot send a message without specifying a recipient.');
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function ttl(): void {
        $ttl = $this->params->getTtl();

        if (null === $ttl) {
            return;
        }

        if (0 === $ttl) {
            $this->params->setTtl(null);
            return;
        }

        $min = SmsConstants::TTL_MIN;
        $max = SmsConstants::TTL_MAX;

        if ($ttl < $min) {
            throw new InvalidOptionalArgumentException(
                "ttl must be at least $min.");
        }

        if ($ttl > $max) {
            throw new InvalidOptionalArgumentException(
                "ttl may not exceed $max.");
        }
    }
}