<?php declare(strict_types=1);

namespace Seven\Api\Validator;

use Datetime;
use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Resource\Sms\SmsConstants;
use Seven\Api\Resource\Sms\SmsParams;

trait SmsRules {
    protected SmsParams $params;

    /** @throws InvalidOptionalArgumentException */
    public function delay(): void {
        $delay = $this->params->getDelay();

        if (!$delay) return;

        if ($delay < new DateTime)
            throw new InvalidOptionalArgumentException('Delay must be a value from the future');
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
