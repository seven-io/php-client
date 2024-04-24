<?php declare(strict_types=1);

namespace Seven\Api\Validator;

use Seven\Api\Constant\PricingConstants;
use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Params\PricingParams;

class PricingValidator
{
    public function __construct(protected PricingParams $params)
    {
    }

    /** @throws InvalidOptionalArgumentException */
    public function validate(): void
    {
        $this->country();
    }

    /** @throws InvalidOptionalArgumentException */
    public function country(): void
    {
        $country = $this->params->getCountry();
        if (!$country) return;

        $len = strlen($country);
        if ($len > PricingConstants::COUNTRY_MAX_LENGTH) {
            throw new InvalidOptionalArgumentException(
                "'country' exceeded length limit: Received $len chars but expected max "
                . PricingConstants::COUNTRY_MAX_LENGTH);
        }
    }
}
