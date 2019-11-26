<?php

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidOptionalArgumentException;

class PricingValidator extends BaseValidator implements ValidatorInterface
{
    function __construct(array $parameters)
    {
        parent::__construct($parameters);
    }

    function validate()
    {
        $this->country();
        $this->format();
        $this->type();
    }

    function country()
    {
        $country = isset($this->parameters["country"]) ? $this->parameters["country"] : null;

        if (null !== $country && !strlen($country)) {
            throw new InvalidOptionalArgumentException("country seems to be invalid: $country.");
        }
    }

    function format()
    {
        $format = isset($this->parameters["format"]) ? $this->parameters["format"] : null;

        if (null !== $format && !in_array($format, ["csv", "json"])) {
            throw new InvalidOptionalArgumentException("format seems to be invalid: $format.");
        }
    }

    function type()
    {
        $this->throwOnOptionalBadType();
    }
}