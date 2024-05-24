<?php declare(strict_types=1);

namespace Seven\Api\Validator;

use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Params\PricingParams;

class PricingValidator {
    public const COUNTRY_MAX_LENGTH = 3;

    public function __construct(protected PricingParams $params) {
    }

    /** @throws InvalidOptionalArgumentException */
    public function validate(): void {
        $this->country();
    }

    /** @throws InvalidOptionalArgumentException */
    public function country(): void {
        $country = $this->params->getCountry();
        if (!$country) return;

        $len = strlen($country);
        if ($len > self::COUNTRY_MAX_LENGTH) {
            throw new InvalidOptionalArgumentException(
                "'country' exceeded length limit: Received $len chars but expected max "
                . self::COUNTRY_MAX_LENGTH);
        }
    }
}
