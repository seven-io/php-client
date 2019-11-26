<?php

namespace Sms77\Api\Validator;

use Exception;

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

        if (!strlen($country)) {
            throw new Exception("Invalid optional parameter country: $country.");
        }
    }

    function format()
    {
        $format = isset($this->parameters["format"]) ? $this->parameters["format"] : null;

        if (!in_array($format, ["csv", "json"])) {
            throw new Exception("Invalid optional parameter format: $format.");
        }
    }

    function type()
    {
        $type = isset($this->parameters["type"]) ? $this->parameters["type"] : null;

        if (!in_array($type, ["direct", "economy"])) {
            throw new Exception("Invalid optional parameter type: $type.");
        }
    }
}