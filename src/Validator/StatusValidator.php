<?php

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidRequiredArgumentException;

class StatusValidator extends BaseValidator implements ValidatorInterface
{
    function __construct(array $parameters)
    {
        parent::__construct($parameters);
    }

    function validate()
    {
        $this->msg_id();
    }

    function msg_id()
    {
        $msgId = isset($this->parameters["msg_id"]) ? $this->parameters["msg_id"] : null;

        if (!strlen($msgId)) {
            throw new InvalidRequiredArgumentException("msg_id is missing.");
        }
    }
}