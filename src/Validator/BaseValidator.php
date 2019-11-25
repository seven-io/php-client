<?php

namespace Sms77\Api\Validator;

class BaseValidator
{
    /* @var array $parameters */
    protected $parameters;

    function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    private function isValidBool($data)
    {
        return 1 == $data || 0 == $data;
    }
}