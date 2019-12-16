<?php

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidRequiredArgumentException;

class StatusValidator extends BaseValidator implements ValidatorInterface
{
    public function validate()
    {
        $this->msg_id();
    }

    public function msg_id()
    {
        $msgId = isset($this->parameters['msg_id']) ? $this->parameters['msg_id'] : null;

        if ('' === $msgId) {
            throw new InvalidRequiredArgumentException('Parameter "msg_id" is missing.');
        }
    }
}