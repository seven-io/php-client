<?php

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

class LookupValidator extends BaseValidator implements ValidatorInterface
{
    function __construct(array $parameters)
    {
        parent::__construct($parameters);
    }

    function validate()
    {
        $this->json();
        $this->number();
        $this->type();
    }

    function json()
    {
        $json = isset($this->parameters["json"]) ? $this->parameters["json"] : null;

        if (null !== $json) {
            $type = isset($this->parameters["type"]) ? $this->parameters["type"] : null;

            if ("mnp" !== $type) {
                throw new InvalidOptionalArgumentException("json may only be set if type is set to mnp.");
            }

            if (!$this->isValidBool($json)) {
                throw new InvalidOptionalArgumentException("json can be either 1 or 0.");
            }
        }
    }

    function number()
    {
        $number = isset($this->parameters["number"]) ? $this->parameters["number"] : null;

        if (!isset($this->parameters["number"]) || !strlen($number)) {
            throw new InvalidRequiredArgumentException("number is missing.");
        }
    }

    function type()
    {
        $type = isset($this->parameters["type"]) ? $this->parameters["type"] : null;

        if (!in_array($type, ["cnam", "format", "hlr", "mnp"])) {
            throw new InvalidRequiredArgumentException("type seems to have an invalid value: $type.");
        }
    }
}