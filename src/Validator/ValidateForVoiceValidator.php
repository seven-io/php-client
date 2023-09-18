<?php declare(strict_types=1);

namespace Seven\Api\Validator;

use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Library\Util;
use Seven\Api\Params\ValidateForVoiceParams;

class ValidateForVoiceValidator {
    protected ValidateForVoiceParams $params;

    public function __construct(ValidateForVoiceParams $params) {
        $this->params = $params;
    }

    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function validate(): void {
        $this->callback();
        $this->number();
    }

    /** @throws InvalidOptionalArgumentException */
    public function callback(): void {
        $callback = $this->params->getCallback();

        if (null !== $callback && !Util::isValidUrl($callback))
            throw new InvalidOptionalArgumentException(
                'Parameter "callback" is not a valid URL.');
    }

    /** @throws InvalidRequiredArgumentException */
    public function number(): void {
        if ('' === $this->params->getNumber())
            throw new InvalidRequiredArgumentException('Parameter "number" is missing.');
    }
}
