<?php

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

class LookupValidator extends BaseValidator implements ValidatorInterface {
    const TYPE_CNAM = 'cnam';
    const TYPE_FORMAT = 'format';
    const TYPE_HLR = 'hlr';
    const TYPE_MNP = 'mnp';
    const TYPES = [self::TYPE_CNAM, self::TYPE_FORMAT, self::TYPE_HLR, self::TYPE_MNP,];

    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function validate() {
        $this->json();
        $this->number();
        $this->type();
    }

    /**
     * @throws InvalidOptionalArgumentException
     */
    public function json() {
        $json = $this->fallback('json');

        if (null !== $json) {
            $type = $this->fallback('type');

            if (self::TYPE_MNP !== $type) {
                throw new InvalidOptionalArgumentException('json may only be set if type is set to mnp.');
            }

            if (!$this->isValidBool($json)) {
                throw new InvalidOptionalArgumentException('json can be either 1 or 0.');
            }
        }
    }

    /**
     * @throws InvalidRequiredArgumentException
     */
    public function number() {
        $number = $this->fallback('number', '');

        if ('' === $number) {
            throw new InvalidRequiredArgumentException('number is missing.');
        }
    }

    /**
     * @throws InvalidRequiredArgumentException
     */
    public function type() {
        $type = $this->fallback('type');

        if (!in_array($type, self::TYPES, true)) {
            $imploded = implode(',', self::TYPES);

            throw new InvalidRequiredArgumentException(
                "type $type is invalid. Valid types are: $imploded.");
        }
    }
}