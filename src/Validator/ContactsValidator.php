<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Constant\ContactsConstants;
use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

class ContactsValidator extends BaseValidator implements ValidatorInterface {
    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function validate(): void {
        $this->action();
        $this->json();
    }

    /** @throws InvalidRequiredArgumentException */
    public function action(): void {
        $action = $this->fallback('action');

        if (!in_array($action, ContactsConstants::ACTIONS)) {
            throw new InvalidRequiredArgumentException("Unknown action '$action'.");
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function json(): void {
        $json = $this->fallback('json');

        if (null !== $json && !$this->isValidBool($json)) {
            throw new InvalidOptionalArgumentException('json must be 1 or 0.');
        }
    }
}