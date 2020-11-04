<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

class ValidateForVoiceValidator extends BaseValidator implements ValidatorInterface {
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
        $callback = $this->fallback('callback');

        if ((null !== $callback) && !filter_var($callback, FILTER_VALIDATE_URL)) {
            throw new InvalidOptionalArgumentException(
                'Parameter "callback" is not a valid URL.');
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function number(): void {
        if ('' === $this->fallback('number', '')) {
            throw new InvalidRequiredArgumentException('Parameter "number" is missing.');
        }
    }
}