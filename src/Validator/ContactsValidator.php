<?php

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

class ContactsValidator extends BaseValidator implements ValidatorInterface {
    const ACTIONS = ['read', 'write', 'del'];

    public function validate() {
        $this->action();
        $this->json();
    }

    public function action() {
        $action = $this->fallback('action');

        if (!in_array($action, self::ACTIONS, true)) {
            throw new InvalidRequiredArgumentException("Unknown action $action.");
        }
    }

    public function json() {
        $json = $this->fallback('json');

        if ((null !== $json) && !$this->isValidBool($json)) {
            throw new InvalidOptionalArgumentException('json can be either 1 or 0.');
        }
    }
}