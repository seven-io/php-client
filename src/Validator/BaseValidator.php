<?php

namespace Sms77\Api\Validator;

use Exception;

class BaseValidator
{
    /* @var array $parameters */
    protected $parameters;

    function __construct(array $parameters)
    {
        $this->parameters = $parameters;

        if (!isset($parameters["p"])) {
            throw new Exception("The required parameter p is missing.");
        }
    }

    protected function isValidBool($data)
    {
        return 1 == $data || 0 == $data;
    }
}