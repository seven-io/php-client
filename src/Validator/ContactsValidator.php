<?php declare(strict_types=1);

namespace Seven\Api\Validator;

use Seven\Api\Constant\ContactsAction;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Params\ContactsParams;

class ContactsValidator {
    protected ContactsParams $params;

    public function __construct(ContactsParams $params) {
        $this->params = $params;
    }

    /**
     * @throws InvalidRequiredArgumentException
     */
    public function validate(): void {
        $this->action();
    }

    /** @throws InvalidRequiredArgumentException */
    public function action(): void {
        $action = $this->params->getAction();

        switch ($action) {
            case ContactsAction::DELETE:
                $this->delete();
                break;
            case ContactsAction::READ:
                $this->read();
                break;
            case ContactsAction::WRITE:
                $this->write();
                break;

            default:
                throw new InvalidRequiredArgumentException('Unknown action: ' . $action);
        }
    }

    /**
     * @throws InvalidRequiredArgumentException
     */
    public function delete(): void {
        $id = $this->params->getId();

        if ($id === null)
            throw new InvalidRequiredArgumentException('Missing parameter id');
    }

    public function read(): void {
    }

    public function write(): void {
    }
}
