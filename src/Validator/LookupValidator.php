<?php

namespace Sms77\Api\Validator;

use Exception;

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
                throw new Exception("The parameter json may only be set if type is set to mnp.");
            }

            if (!$this->isValidBool($json)) {
                throw new Exception("The parameter json can be either 1 or 0.");
            }
        }
    }

    function number()
    {
        $number = isset($this->parameters["number"]) ? $this->parameters["number"] : null;

        if (!isset($this->parameters["number"]) || !strlen($number)) {
            throw new Exception("Required parameter number is missing.");
        }
    }

    function type()
    {
        $type = isset($this->parameters["type"]) ? $this->parameters["type"] : null;

        if (!in_array($type, ["cnam", "format", "hlr", "mnp"])) {
            throw new Exception("Invalid required parameter type: $type.");
        }
    }
}