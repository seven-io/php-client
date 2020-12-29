<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Constant\SmsConstants;
use Sms77\Api\Exception\InvalidBooleanOptionException;
use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;
use Sms77\Api\Library\Util;

class SmsValidator extends BaseValidator implements ValidatorInterface {
    public function __construct(array $parameters = []) {
        parent::__construct($parameters, [
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
        $delay = $this->fallback('delay');

        if (null !== $delay) {
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
    }

    /** @throws InvalidOptionalArgumentException */
    public function foreign_id(): void {
        $label = $this->fallback('foreign_id');

        if (null !== $label) {
            if (mb_strlen($label) > SmsConstants::FOREIGN_ID_MAX_LENGTH) {
                throw new InvalidOptionalArgumentException('foreign_id must not exceed "'
                    . SmsConstants::LABEL_MAX_LENGTH . '" characters in length.');
            }

            if (strlen($label) !== preg_match_all(SmsConstants::FOREIGN_ID_PATTERN, $label)) {
                throw new InvalidOptionalArgumentException(
                    'foreign_id must match the regex pattern ' . SmsConstants::LABEL_PATTERN);
            }
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function from(): void {
        $from = $this->fallback('from');

        if (null !== $from) {
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

            if (!ctype_alnum(str_ireplace(SmsConstants::FROM_ALLOWED_CHARS, '', $from))) {
                throw new InvalidOptionalArgumentException(
                    "Argument 'from' must be alphanumeric.");
            }
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function label(): void {
        $label = $this->fallback('label');

        if (null !== $label) {
            if (mb_strlen($label) > SmsConstants::LABEL_MAX_LENGTH) {
                throw new InvalidOptionalArgumentException('label must not exceed "'
                    . SmsConstants::LABEL_MAX_LENGTH . '" characters in length.');
            }

            if (strlen($label) !== preg_match_all(SmsConstants::LABEL_PATTERN, $label)) {
                throw new InvalidOptionalArgumentException(
                    'label must match the regex pattern ' . SmsConstants::LABEL_PATTERN);
            }
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function text(): void {
        $text = $this->fallback('text');

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
        if (null === $this->fallback('to')) {
            throw new InvalidRequiredArgumentException(
                'You cannot send a message without specifying a recipient.');
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function ttl(): void {
        $ttl = $this->fallback('ttl');

        if (null !== $ttl) {
            $min = SmsConstants::TTL_MIN;
            $max = SmsConstants::TTL_MAX;

            if ($ttl < $min) {
                throw new InvalidOptionalArgumentException("ttl must be at least $min.");
            }

            if ($ttl > $max) {
                throw new InvalidOptionalArgumentException("ttl may not exceed $max.");
            }
        }
    }
}