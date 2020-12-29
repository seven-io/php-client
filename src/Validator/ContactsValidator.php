<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Constant\ContactsConstants;
use Sms77\Api\Exception\InvalidBooleanOptionException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

class ContactsValidator extends BaseValidator implements ValidatorInterface {
    public function __construct(array $parameters = []) {
        parent::__construct($parameters, ['json']);
    }

    /**
     * @throws InvalidRequiredArgumentException
     * @throws InvalidBooleanOptionException
     */
    public function validate(): void {
        $this->action();

        parent::validate();
    }

    /** @throws InvalidRequiredArgumentException */
    public function action(): void {
        $action = $this->fallback('action');

        if (!in_array($action, ContactsConstants::ACTIONS)) {
            throw new InvalidRequiredArgumentException(
                "Unknown action '$action'.");
        }
    }
}