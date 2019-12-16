<?php

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

class ValidateForVoiceValidator extends BaseValidator implements ValidatorInterface
{
    public function validate()
    {
        $this->callback();
        $this->number();
    }

    public function callback()
    {
        $callback = isset($this->parameters['callback']) ? $this->parameters['callback'] : null;

        if ((null !== $callback) && !filter_var($callback, FILTER_VALIDATE_URL)) {
            throw new InvalidOptionalArgumentException('Parameter "callback" is not a valid URL.');
        }
    }

    public function number()
    {
        $number = isset($this->parameters['number']) ? $this->parameters['number'] : null;

        if ('' === $number) {
            throw new InvalidRequiredArgumentException('Parameter "number" is missing.');
        }
    }
}