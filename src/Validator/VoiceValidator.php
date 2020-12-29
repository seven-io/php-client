<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidBooleanOptionException;
use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

class VoiceValidator extends BaseValidator implements ValidatorInterface {
    public function __construct(array $parameters = []) {
        parent::__construct($parameters, ['xml']);
    }

    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     * @throws InvalidBooleanOptionException
     */
    public function validate(): void {
        $this->from();
        $this->text();
        $this->to();

        parent::validate();
    }

    /** @throws InvalidOptionalArgumentException */
    public function from(): void {
        $from = $this->fallback('from');

        if (null !== $from && '' === $from) {
            throw new InvalidOptionalArgumentException('from may not be empty if set.');
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function text(): void {
        if ('' === $this->fallback('text', '')) {
            throw new InvalidRequiredArgumentException('text is missing.');
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function to(): void {
        if ('' === $this->fallback('to', '')) {
            throw new InvalidRequiredArgumentException('to is missing.');
        }
    }
}