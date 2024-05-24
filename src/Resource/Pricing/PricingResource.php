<?php declare(strict_types=1);

namespace Seven\Api\Resource\Pricing;

use Random\RandomException;
use Seven\Api\Exception\ForbiddenIpException;
use Seven\Api\Exception\InvalidApiKeyException;
use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\MissingAccessRightsException;
use Seven\Api\Exception\SigningHashVerificationException;
use Seven\Api\Exception\UnexpectedApiResponseException;
use Seven\Api\Resource\Resource;
use Seven\Api\Validator\PricingValidator;

class PricingResource extends Resource {
    /**
     * @throws ForbiddenIpException
     * @throws InvalidApiKeyException
     * @throws InvalidOptionalArgumentException
     * @throws MissingAccessRightsException
     * @throws RandomException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     */
    public function get(PricingParams $params = new PricingParams): Pricing {
        $this->validate($params);
        $res = $this->client->get('pricing', $params->toArray());
        return new Pricing($res);
    }

    /** @throws InvalidOptionalArgumentException */
    public function validate(PricingParams $params): void {
        (new PricingValidator($params))->validate();
    }
}
