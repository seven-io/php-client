<?php declare(strict_types=1);

namespace Seven\Api\Validator;

use Seven\Api\Constant\LookupType;
use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Params\LookupParams;

class LookupValidator {
    protected LookupParams $params;

    public function __construct(LookupParams $params) {
        $this->params = $params;
    }

    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function validate(): void {
        $this->json();
        $this->number();
        $this->type();
    }

    /** @throws InvalidOptionalArgumentException */
    public function json(): void {
        if (null === $this->params->getJson()) return;

        $type = $this->params->getType();

        if (LookupType::MobileNumberPortability !== $type) {
            throw new InvalidOptionalArgumentException(
                'json may only be set if type is set to mnp.');
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function number(): void {
        $numbers = $this->params->getNumbers();

        if (empty($numbers)) throw new InvalidRequiredArgumentException('number(s) are missing.');
    }

    /** @throws InvalidRequiredArgumentException */
    public function type(): void {
        $type = $this->params->getType();
        $values = LookupType::values();

        if (!in_array($type, $values, true)) {
            $imploded = implode(',', $values);

            throw new InvalidRequiredArgumentException(
                "type $type is invalid. Valid types are: $imploded.");
        }
    }
}
