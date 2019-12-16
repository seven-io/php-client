<?php

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidOptionalArgumentException;

class PricingValidator extends BaseValidator implements ValidatorInterface
{
    public function validate()
    {
        $this->country();
        $this->format();
        $this->type();
    }

    public function country()
    {
        $country = isset($this->parameters['country']) ? $this->parameters['country'] : null;

        if (null !== $country && '' === $country) {
            throw new InvalidOptionalArgumentException("country seems to be invalid: $country.");
        }
    }

    public function format()
    {
        $format = isset($this->parameters['format']) ? $this->parameters['format'] : null;

        if (null !== $format && !in_array($format, ['csv', 'json'])) {
            throw new InvalidOptionalArgumentException("format seems to be invalid: $format.");
        }
    }

    public function type()
    {
        $this->throwOnOptionalBadType();
    }
}