<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidRequiredArgumentException;

class StatusValidator extends BaseValidator implements ValidatorInterface {
    /** @throws InvalidRequiredArgumentException */
    public function validate(): void {
        $this->msg_id();
    }

    /** @throws InvalidRequiredArgumentException */
    public function msg_id(): void {
        if (!is_numeric($this->fallback('msg_id'))) {
            throw new InvalidRequiredArgumentException('Parameter "msg_id" is invalid.');
        }
    }
}