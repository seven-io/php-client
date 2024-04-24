<?php declare(strict_types=1);

namespace Seven\Api\Resource;

use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Params\PricingParams;
use Seven\Api\Response\Pricing\Pricing;
use Seven\Api\Validator\PricingValidator;

class PricingResource extends Resource
{
    /**
     * @throws InvalidOptionalArgumentException
     */
    public function get(string $country = null): Pricing
    {
        $params = (new PricingParams)->setCountry($country);
        $res = $this->fetch($params);
        return new Pricing($res);
    }

    /**
     * @return string|object
     * @throws InvalidOptionalArgumentException
     */
    protected function fetch(PricingParams $params = null)
    {
        if (!$params) $params = new PricingParams;

        $this->validate($params);

        return $this->client->get('pricing', $params->toArray());
    }

    /**
     * @param PricingParams $params
     * @throws InvalidOptionalArgumentException
     */
    public function validate($params): void
    {
        (new PricingValidator($params))->validate();
    }
}
