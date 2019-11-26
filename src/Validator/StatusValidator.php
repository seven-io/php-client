<?php

namespace Sms77\Api\Validator;

use Exception;

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
            throw new Exception("The required parameter msg_id is missing.");
        }
    }
}