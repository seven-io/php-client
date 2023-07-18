<?php declare(strict_types=1);

namespace Seven\Api\Validator;

use Seven\Api\Constant\LookupConstants;
use Seven\Api\Exception\InvalidBooleanOptionException;
use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\InvalidRequiredArgumentException;

class LookupValidator extends BaseValidator implements ValidatorInterface {
    public function __construct(array $parameters = []) {
        parent::__construct($parameters, ['json']);
    }

    public static function isValidMobileNetworkShortName(string $subject): bool {
        return in_array($subject, LookupConstants::MNP_TYPES);
    }

    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     * @throws InvalidBooleanOptionException
     */
    public function validate(): void {
        $this->json();
        $this->number();
        $this->type();

        parent::validate();
    }

    /** @throws InvalidOptionalArgumentException */
    public function json(): void {
        if (null === $this->fallback('json')) {
            return;
        }

        $type = $this->fallback('type');

        if (LookupConstants::TYPE_MNP !== $type) {
            throw new InvalidOptionalArgumentException(
                'json may only be set if type is set to mnp.');
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function number(): void {
        $number = $this->fallback('number', '');

        if ('' === $number) {
            throw new InvalidRequiredArgumentException('number is missing.');
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function type(): void {
        $type = $this->fallback('type');

        if (!in_array($type, LookupConstants::TYPES, true)) {
            $imploded = implode(',', LookupConstants::TYPES);

            throw new InvalidRequiredArgumentException(
                "type $type is invalid. Valid types are: $imploded.");
        }
    }
}
