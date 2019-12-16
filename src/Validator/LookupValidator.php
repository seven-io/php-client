<?php

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

class LookupValidator extends BaseValidator implements ValidatorInterface
{
    public function validate()
    {
        $this->json();
        $this->number();
        $this->type();
    }

    public function json()
    {
        $json = isset($this->parameters['json']) ? $this->parameters['json'] : null;

        if (null !== $json) {
            $type = isset($this->parameters['type']) ? $this->parameters['type'] : null;

            if ('mnp' !== $type) {
                throw new InvalidOptionalArgumentException('json may only be set if type is set to mnp.');
            }

            if (!$this->isValidBool($json)) {
                throw new InvalidOptionalArgumentException('json can be either 1 or 0.');
            }
        }
    }

    public function number()
    {
        $number = isset($this->parameters['number']) ? $this->parameters['number'] : null;

        if (!isset($this->parameters['number']) || '' === $number) {
            throw new InvalidRequiredArgumentException('number is missing.');
        }
    }

    public function type()
    {
        $type = isset($this->parameters['type']) ? $this->parameters['type'] : null;

        $types = ['cnam', 'format', 'hlr', 'mnp'];

        if (!in_array($type, $types, true)) {
            $imploded = implode(',', $types);

            throw new InvalidRequiredArgumentException("type $type is invalid. Valid types are: $imploded.");
        }
    }
}