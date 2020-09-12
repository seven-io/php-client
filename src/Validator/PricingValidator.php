<?php

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidOptionalArgumentException;

class PricingValidator extends BaseValidator implements ValidatorInterface {
    const FORMATS = ['csv', 'json'];

    public function validate() {
        $this->country();
        $this->format();
        $this->type();
    }

    public function country() {
        $country = $this->fallback('country');

        if (null !== $country && '' === $country) {
            throw new InvalidOptionalArgumentException("country seems to be invalid: $country.");
        }
    }

    public function format() {
        $format = $this->fallback('format');

        if (null !== $format && !in_array($format, self::FORMATS)) {
            throw new InvalidOptionalArgumentException("format seems to be invalid: $format.");
        }
    }

    public function type() {
        $this->throwOnOptionalBadType();
    }
}