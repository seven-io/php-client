<?php

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

class ContactsValidator extends BaseValidator implements ValidatorInterface {
    const ACTIONS = ['read', 'write', 'del'];

    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function validate() {
        $this->action();
        $this->json();
    }

    /**
     * @throws InvalidRequiredArgumentException
     */
    public function action() {
        $action = $this->fallback('action');

        if (!in_array($action, self::ACTIONS, true)) {
            throw new InvalidRequiredArgumentException("Unknown action $action.");
        }
    }

    /**
     * @throws InvalidOptionalArgumentException
     */
    public function json() {
        $json = $this->fallback('json');

        if ((null !== $json) && !$this->isValidBool($json)) {
            throw new InvalidOptionalArgumentException('json can be either 1 or 0.');
        }
    }
}