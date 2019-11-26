<?php

namespace Sms77\Api\Validator;

use Exception;

class ValidateForVoiceValidator extends BaseValidator implements ValidatorInterface
{
    function __construct(array $parameters)
    {
        parent::__construct($parameters);
    }

    function validate()
    {
        $this->callback();
        $this->number();
    }

    function callback()
    {
        $callback = isset($this->parameters["callback"]) ? $this->parameters["callback"] : null;

        if (null !== $callback) {
            if (filter_var($callback, FILTER_VALIDATE_URL)) {
                throw new Exception("The optional parameter callback is not a valid URL.");
            }
        }
    }

    function number()
    {
        $number = isset($this->parameters["number"]) ? $this->parameters["number"] : null;

        if (!strlen($number)) {
            throw new Exception("The required parameter number is missing.");
        }
    }
}