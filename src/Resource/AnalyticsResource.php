<?php declare(strict_types=1);

namespace Seven\Api\Resource;

use Random\RandomException;
use Seven\Api\Exception\ForbiddenIpException;
use Seven\Api\Exception\InvalidApiKeyException;
use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\MissingAccessRightsException;
use Seven\Api\Exception\SigningHashVerificationException;
use Seven\Api\Exception\UnexpectedApiResponseException;
use Seven\Api\Params\AnalyticsParams;
use Seven\Api\Response\Analytics\AbstractAnalytic;
use Seven\Api\Response\Analytics\AnalyticByCountry;
use Seven\Api\Response\Analytics\AnalyticByDate;
use Seven\Api\Response\Analytics\AnalyticByLabel;
use Seven\Api\Response\Analytics\AnalyticBySubaccount;
use Seven\Api\Validator\AnalyticsValidator;

class AnalyticsResource extends Resource {
    /**
     * @return AnalyticByCountry[]
     * @throws ForbiddenIpException
     * @throws InvalidApiKeyException
     * @throws InvalidOptionalArgumentException
     * @throws MissingAccessRightsException
     * @throws RandomException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     */
    public function byCountry(AnalyticsParams $params = new AnalyticsParams): array {
        return $this->fetch($params, 'country', AnalyticByCountry::class);
    }

    /**
     * @return AbstractAnalytic[]
     * @throws InvalidOptionalArgumentException
     * @throws RandomException
     * @throws ForbiddenIpException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     */
    protected function fetch(AnalyticsParams $params, string $groupBy, string $class): array {
        $this->validate($params);

        $arr = $this->client->get('analytics/' . $groupBy, $params->toArray());
        return array_map(static fn($value) => new $class($value), $arr);
    }

    /**
     * @param AnalyticsParams $params
     * @throws InvalidOptionalArgumentException
     */
    public function validate($params): void {
        (new AnalyticsValidator($params))->validate();
    }

    /**
     * @return AnalyticByDate[]
     * @throws ForbiddenIpException
     * @throws InvalidApiKeyException
     * @throws InvalidOptionalArgumentException
     * @throws MissingAccessRightsException
     * @throws RandomException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     */
    public function byDate(AnalyticsParams $params = new AnalyticsParams): array {
        return $this->fetch($params, 'date', AnalyticByDate::class);
    }

    /**
     * @return AnalyticByLabel[]
     * @throws ForbiddenIpException
     * @throws InvalidApiKeyException
     * @throws InvalidOptionalArgumentException
     * @throws MissingAccessRightsException
     * @throws RandomException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     */
    public function byLabel(AnalyticsParams $params = new AnalyticsParams): array {
        return $this->fetch($params, 'label', AnalyticByLabel::class);
    }

    /**
     * @return AnalyticBySubaccount[]
     * @throws ForbiddenIpException
     * @throws InvalidApiKeyException
     * @throws InvalidOptionalArgumentException
     * @throws MissingAccessRightsException
     * @throws RandomException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     */
    public function bySubaccount(AnalyticsParams $params = new AnalyticsParams): array {
        return $this->fetch($params, 'subaccount', AnalyticBySubaccount::class);
    }
}
