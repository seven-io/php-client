<?php

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

class BaseValidator
{
    /* @var array $parameters */
    protected $parameters;

    protected $allowedTypes = ["direct", "economy"];

    function __construct(array $parameters)
    {
        $this->parameters = $parameters;

        if (!isset($parameters["p"])) {
            throw new InvalidRequiredArgumentException("p is missing.");
        }
    }

    protected function isValidBool($data)
    {
        return 1 == $data || 0 == $data;
    }

    protected function throwOnOptionalBadType()
    {
        $types = ["direct", "economy"];

        $type = isset($this->parameters["type"]) ? $this->parameters["type"] : null;

        if (null !== $type && !in_array($type, $types)) {
            throw new InvalidOptionalArgumentException("type has invalid value $type. Allowed values are: " . join(",", $types) . ".");
        }
    }

    protected function isValidUnixTimestamp($timestamp)
    {
        /*https://stackoverflow.com/questions/2524680/check-whether-the-string-is-a-unix-timestamp*/
        return ((string)$timestamp === $timestamp)
            && ($timestamp <= PHP_INT_MAX)
            && ($timestamp >= ~PHP_INT_MAX);
    }
}