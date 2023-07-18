<?php declare(strict_types=1);

namespace Seven\Api\Validator;

use Seven\Api\Constant\ContactsConstants;
use Seven\Api\Exception\InvalidBooleanOptionException;
use Seven\Api\Exception\InvalidRequiredArgumentException;

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
