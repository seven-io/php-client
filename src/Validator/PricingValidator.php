<?php declare(strict_types=1);

namespace Seven\Api\Validator;

use Seven\Api\Constant\PricingConstants;
use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Params\PricingParams;

class PricingValidator {
    protected PricingParams $params;

    public function __construct(PricingParams $params) {
        $this->params = $params;
    }

    /** @throws InvalidOptionalArgumentException */
    public function validate(): void {
        $this->country();
        $this->format();
    }

    /** @throws InvalidOptionalArgumentException */
    public function country(): void {
        $country = $this->params->getCountry();
        if (!$country) return;

        $len = strlen($country);
        if ($len > PricingConstants::COUNTRY_MAX_LENGTH) {
            throw new InvalidOptionalArgumentException(
                "'country' exceeded length limit: Received $len chars but expected max "
                . PricingConstants::COUNTRY_MAX_LENGTH);
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function format(): void {
        $format = $this->params->getFormat();
        if (!$format) return;

        if (!in_array($format, PricingConstants::FORMATS))
            throw new InvalidOptionalArgumentException("format seems to be invalid: $format.");
    }
}
