<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidRequiredArgumentException;

class StatusValidator extends BaseValidator implements ValidatorInterface {
    public function validate() {
        $this->msg_id();
    }

    public function msg_id() {
        if (!is_numeric($this->fallback('msg_id'))) {
            throw new InvalidRequiredArgumentException('Parameter "msg_id" is invalid.');
        }
    }
}