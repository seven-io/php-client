<?php

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidOptionalArgumentException;

class PricingValidator extends BaseValidator implements ValidatorInterface {
    const FORMATS = ['csv', 'json'];

    /**
     * @throws InvalidOptionalArgumentException
     */
    public function validate() {
        $this->country();
        $this->format();
        $this->type();
    }

    /**
     * @throws InvalidOptionalArgumentException
     */
    public function country() {
        $country = $this->fallback('country');

        if (null !== $country && '' === $country) {
            throw new InvalidOptionalArgumentException("country seems to be invalid: $country.");
        }
    }

    /**
     * @throws InvalidOptionalArgumentException
     */
    public function format() {
        $format = $this->fallback('format');

        if (null !== $format && !in_array($format, self::FORMATS)) {
            throw new InvalidOptionalArgumentException("format seems to be invalid: $format.");
        }
    }

    /**
     * @throws InvalidOptionalArgumentException
     */
    public function type() {
        $this->throwOnOptionalBadType();
    }
}