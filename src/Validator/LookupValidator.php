<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Constant\LookupConstants;
use Sms77\Api\Exception\InvalidBooleanOptionException;
use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

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