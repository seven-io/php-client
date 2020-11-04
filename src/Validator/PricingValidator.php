<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidOptionalArgumentException;

class PricingValidator extends BaseValidator implements ValidatorInterface {
    public const COUNTRY_MAX_LENGTH = 3;
    public const FORMATS = ['csv', 'json'];

    /** @throws InvalidOptionalArgumentException */
    public function validate(): void {
        $this->country();
        $this->format();
        $this->type();
    }

    /** @throws InvalidOptionalArgumentException */
    public function country(): void {
        $country = $this->fallback('country', '');

        $len = strlen($country);
        if ($len > self::COUNTRY_MAX_LENGTH) {
            throw new InvalidOptionalArgumentException(
                "'country' exceeded length limit: Received $len chars but expected max "
                . self::COUNTRY_MAX_LENGTH);
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function format(): void {
        $format = $this->fallback('format');

        if (null !== $format && !in_array($format, self::FORMATS)) {
            throw new InvalidOptionalArgumentException("format seems to be invalid: $format.");
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function type(): void {
        $this->throwOnOptionalBadType();
    }
}