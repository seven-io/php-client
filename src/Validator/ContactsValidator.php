<?php

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

class ContactsValidator extends BaseValidator implements ValidatorInterface
{
    public function validate()
    {
        $this->action();
        $this->json();
    }

    public function action()
    {
        $action = isset($this->parameters['action']) ? $this->parameters['action'] : null;

        $actions = ['read', 'write', 'del'];

        if (!in_array($action, $actions, true)) {
            throw new InvalidRequiredArgumentException("Unknown action $action.");
        }
    }

    public function json()
    {
        $json = isset($this->parameters['json']) ? $this->parameters['json'] : null;

        if ((null !== $json) && !$this->isValidBool($json)) {
            throw new InvalidOptionalArgumentException('json can be either 1 or 0.');
        }
    }
}