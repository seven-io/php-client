<?php

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

class VoiceValidator extends BaseValidator implements ValidatorInterface {
    public function validate() {
        $this->from();
        $this->text();
        $this->to();
        $this->xml();
    }

    public function from() {
        $from = $this->fallback('from');

        if (null !== $from && '' === $from) {
            throw new InvalidOptionalArgumentException('from may not be empty if set.');
        }
    }

    public function text() {
        if ('' === $this->fallback('text', '')) {
            throw new InvalidRequiredArgumentException('text is missing.');
        }
    }

    public function to() {
        if ('' === $this->fallback('to', '')) {
            throw new InvalidRequiredArgumentException('to is missing.');
        }
    }

    public function xml() {
        $xml = $this->fallback('xml', '');

        if (!$this->isValidBool($xml)) {
            throw new InvalidOptionalArgumentException('xml can be either 1 or 0.');
        }
    }
}