<?php

namespace Sms77\Api\Validator;

use Sms77\Api\Constant\SmsType;
use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

class SmsValidator extends BaseValidator implements ValidatorInterface {
    const DELAY_DATE_FORMAT = 'yyyy-mm-dd hh:ii';
    const DELAY_PATTERN = '/^([0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/';
    const LABEL_PATTERN = "/[0-9a-z\-@_.]/i";
    const FROM_ALPHANUMERIC_MAX = 11;
    const FROM_NUMERIC_MAX = 16;
    const FROM_ALLOWED_CHARS = ['/', ' ', '.', '-', '@', '_', '!', '(', ')', '+', '$', ',', '&',];
    const TEXT_MAX_LENGTH = 1520;
    const TTL_MIN = 300000;
    const TTL_MAX = 86400000;

    public function validate() {
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

    public function debug() {
        $debug = $this->fallback('debug');

        if ((null !== $debug) && !$this->isValidBool($debug)) {
            throw new InvalidOptionalArgumentException('debug can be either 1 or 0.');
        }
    }

    public function delay() {
        $delay = $this->fallback('delay');

        if (null !== $delay) {
            $errorMsg = "Delay must be a valid UNIX timestamp or in the format of "
                . self::DELAY_DATE_FORMAT . '.';

            if (false === strpos($delay, '-')) {
                if (!$this->isValidUnixTimestamp($delay)) {
                    throw new InvalidOptionalArgumentException($errorMsg);
                }
            } else {
                $dateParts = explode('-', $delay);

                if (!preg_match(self::DELAY_PATTERN, $dateParts[3] . ':' . $dateParts[4])) {
                    throw new InvalidOptionalArgumentException($errorMsg);
                }

                if (!checkdate($dateParts[1], $dateParts[2], $dateParts[0])) {
                    throw new InvalidOptionalArgumentException($errorMsg);
                }
            }
        }
    }

    public function details() {
        $details = $this->fallback('details');

        if (null !== $details && !$this->isValidBool($details)) {
            throw new InvalidOptionalArgumentException('details can be either 1 or 0.');
        }
    }

    public function flash() {
        $flash = $this->fallback('flash');

        if (null !== $flash) {
            if (!$this->isValidBool($flash)) {
                throw new InvalidOptionalArgumentException("Argument 'flash' can be either 1 or 0.");
            }

            $allowedType = SmsType::Direct;
            if ($allowedType !== $this->parameters['type'] && $flash) {
                throw new InvalidOptionalArgumentException(
                    "Only messages of type '$allowedType' can be sent as 'flash' messages.");
            }

        }
    }

    public function from() {
        $from = $this->fallback('from');

        if (null !== $from) {
            $length = strlen($from);

            $alphaNumericMax = self::FROM_ALPHANUMERIC_MAX;
            $numericMax = self::FROM_NUMERIC_MAX;

            $isNumeric = is_numeric($from);

            if ($length > $numericMax) {
                throw new InvalidOptionalArgumentException("Argument 'from' may not exceed $numericMax chars.");
            }

            if ($length > $alphaNumericMax && !$isNumeric) {
                throw new InvalidOptionalArgumentException(
                    "Argument 'from' must be numeric. if > $alphaNumericMax chars.");
            }

            if (!ctype_alnum(str_ireplace(self::FROM_ALLOWED_CHARS, '', $from))) {
                throw new InvalidOptionalArgumentException("Argument 'from' must be alphanumeric.");
            }
        }
    }

    public function json() {
        $json = $this->fallback('json');

        if ((null !== $json) && !$this->isValidBool($json)) {
            throw new InvalidOptionalArgumentException('json can be either 1 or 0.');
        }
    }

    public function label() {
        //TODO: max length?! there must be one.
        $label = $this->fallback('label');

        if (null !== $label) {
            if (strlen($label) !== preg_match_all(self::LABEL_PATTERN, $label)) {
                throw new InvalidOptionalArgumentException('label must match the regex pattern ' . self::LABEL_PATTERN . '.');
            }
        }
    }

    public function no_reload() {
        $noReload = $this->fallback('no_reload');

        if ((null !== $noReload) && !$this->isValidBool($noReload)) {
            throw new InvalidOptionalArgumentException('no_reload can be either 1 or 0.');
        }
    }

    public function performance_tracking() {
        $performanceTracking = $this->fallback('performance_tracking');

        if ((null !== $performanceTracking) && !$this->isValidBool($performanceTracking)) {
            throw new InvalidOptionalArgumentException('performance_tracking can be either 1 or 0.');
        }
    }

    public function return_msg_id() {
        $returnMsgId = $this->fallback('return_msg_id');

        if ((null !== $returnMsgId) && !$this->isValidBool($returnMsgId)) {
            throw new InvalidOptionalArgumentException('return_msg_id can be either 1 or 0.');
        }
    }

    public function text() {
        $text = $this->fallback('text');

        if (null === $text) {
            throw new InvalidRequiredArgumentException('You cannot send an empty message.');
        }

        $length = strlen($text);

        if (!$length) {
            throw new InvalidRequiredArgumentException('You cannot send an empty message.');
        }

        $maxTextLength = self::TEXT_MAX_LENGTH;

        if ($maxTextLength < $length) {
            throw new InvalidRequiredArgumentException(
                "The text can not be longer than $maxTextLength characters.");
        }
    }

    public function to() {
        if (null === $this->fallback('to')) {
            throw new InvalidRequiredArgumentException(
                'You cannot send a message without specifying a recipient.');
        }
    }

    public function type() {
        $this->throwOnOptionalBadType();
    }

    public function udh() {
        $udh = $this->fallback('udh');

        if (null !== $udh) {
            if (!$this->isValidBool($udh)) {
                throw new InvalidOptionalArgumentException('udh can be either 1 or 0.');
            }

            $allowedType = SmsType::Direct;
            if ($allowedType !== $this->parameters['type'] && $udh) {
                throw new InvalidOptionalArgumentException("Only messages of type '$allowedType' can be sent as udh messages.");
            }
        }
    }

    public function unicode() {
        $unicode = $this->fallback('unicode');

        if (null !== $unicode) {
            if (!$this->isValidBool($unicode)) {
                throw new InvalidOptionalArgumentException('unicode can be either 1 or 0.');
            }

            $allowedType = SmsType::Direct;

            if ($allowedType !== $this->parameters['type'] && $unicode) {
                throw new InvalidOptionalArgumentException("Only messages of type '$allowedType' can be unicode encoded.");
            }
        }
    }

    public function utf8() {
        $utf8 = $this->fallback('utf8');

        if ((null !== $utf8) && !$this->isValidBool($utf8)) {
            throw new InvalidOptionalArgumentException('utf8 can be either 1 or 0.');
        }
    }

    public function ttl() {
        $ttl = $this->fallback('ttl');

        if (null !== $ttl) {
            $min = self::TTL_MIN;
            $max = self::TTL_MAX;

            if ($ttl < $min) {
                throw new InvalidOptionalArgumentException("ttl must be at least $min.");
            }

            if ($ttl > $max) {
                throw new InvalidOptionalArgumentException("ttl may not exceed $max.");
            }
        }
    }
}