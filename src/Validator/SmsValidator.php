<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Constant\SmsConstants;
use Sms77\Api\Constant\SmsType;
use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

class SmsValidator extends BaseValidator implements ValidatorInterface {
    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function validate(): void {
        $this->debug();
        $this->delay();
        $this->details();
        $this->flash();
        $this->from();
        $this->json();
        $this->label();
        $this->no_reload();
        $this->performance_tracking();
        $this->return_msg_id();
        $this->text();
        $this->to();
        $this->type();
        $this->udh();
        $this->unicode();
        $this->utf8();
        $this->ttl();
    }

    /** @throws InvalidOptionalArgumentException */
    public function debug(): void {
        $debug = $this->fallback('debug');

        if ((null !== $debug) && !$this->isValidBool($debug)) {
            throw new InvalidOptionalArgumentException('debug can be either 1 or 0.');
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function delay(): void {
        $delay = $this->fallback('delay');

        if (null !== $delay) {
            $errorMsg = "Delay must be a valid UNIX timestamp or in the format of "
                . SmsConstants::DELAY_DATE_FORMAT . '.';

            if (false === strpos($delay, '-')) {
                if (!$this->isValidUnixTimestamp($delay)) {
                    throw new InvalidOptionalArgumentException($errorMsg);
                }
            } else if (!preg_match(SmsConstants::DELAY_PATTERN, $delay)) {
                throw new InvalidOptionalArgumentException($errorMsg);
            }
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function details(): void {
        $details = $this->fallback('details');

        if (null !== $details && !$this->isValidBool($details)) {
            throw new InvalidOptionalArgumentException('details can be either 1 or 0.');
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function flash(): void {
        $flash = $this->fallback('flash');

        if ($flash) {
            if (!$this->isValidBool($flash)) {
                throw new InvalidOptionalArgumentException(
                    "Argument 'flash' can be either 1 or 0.");
            }

            $allowedType = SmsType::Direct;

            if ($allowedType !== $this->fallback('type', $allowedType)) {
                throw new InvalidOptionalArgumentException(
                    "Only '$allowedType' messages can be sent as 'flash' messages.");
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
    public function json(): void {
        $json = $this->fallback('json');

        if ((null !== $json) && !$this->isValidBool($json)) {
            throw new InvalidOptionalArgumentException('json can be either 1 or 0.');
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

    /** @throws InvalidOptionalArgumentException */
    public function no_reload(): void {
        $noReload = $this->fallback('no_reload');

        if (null !== $noReload && !$this->isValidBool($noReload)) {
            throw new InvalidOptionalArgumentException(
                'no_reload can be either 1 or 0.');
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function performance_tracking(): void {
        $performanceTracking = $this->fallback('performance_tracking');

        if (null !== $performanceTracking && !$this->isValidBool($performanceTracking)) {
            throw new InvalidOptionalArgumentException(
                'performance_tracking can be either 1 or 0.');
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function return_msg_id(): void {
        $returnMsgId = $this->fallback('return_msg_id');

        if (null !== $returnMsgId && !$this->isValidBool($returnMsgId)) {
            throw new InvalidOptionalArgumentException(
                'return_msg_id can be either 1 or 0.');
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function text(): void {
        $text = $this->fallback('text');

        if (null === $text) {
            throw new InvalidRequiredArgumentException(
                'You cannot send an empty message.');
        }

        $length = strlen($text);

        if (!$length) {
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
    public function type(): void {
        $this->throwOnOptionalBadType();
    }

    /** @throws InvalidOptionalArgumentException */
    public function udh(): void {
        $udh = $this->fallback('udh');

        if (null !== $udh) {
            if (!$this->isValidBool($udh)) {
                throw new InvalidOptionalArgumentException('udh can be either 1 or 0.');
            }

            $allowedType = SmsType::Direct;
            if ($allowedType !== $this->parameters['type'] && $udh) {
                throw new InvalidOptionalArgumentException(
                    "Only messages of type '$allowedType' can be sent as udh messages.");
            }
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function unicode(): void {
        $unicode = $this->fallback('unicode');

        if (null !== $unicode) {
            if (!$this->isValidBool($unicode)) {
                throw new InvalidOptionalArgumentException(
                    'unicode can be either 1 or 0.');
            }

            $allowedType = SmsType::Direct;

            if ($allowedType !== $this->parameters['type'] && $unicode) {
                throw new InvalidOptionalArgumentException(
                    "Only messages of type '$allowedType' can be unicode encoded.");
            }
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function utf8(): void {
        $utf8 = $this->fallback('utf8');

        if ((null !== $utf8) && !$this->isValidBool($utf8)) {
            throw new InvalidOptionalArgumentException('utf8 can be either 1 or 0.');
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