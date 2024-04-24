<?php declare(strict_types=1);

namespace Seven\Api\Resource;

use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Params\AnalyticsParams;
use Seven\Api\Response\Analytics\AbstractAnalytic;
use Seven\Api\Response\Analytics\AnalyticByCountry;
use Seven\Api\Response\Analytics\AnalyticByDate;
use Seven\Api\Response\Analytics\AnalyticByLabel;
use Seven\Api\Response\Analytics\AnalyticBySubaccount;
use Seven\Api\Validator\AnalyticsValidator;

class AnalyticsResource extends Resource
{
    /**
     * @return AnalyticByCountry[]
     * @throws InvalidOptionalArgumentException
     */
    public function byCountry(AnalyticsParams $params = new AnalyticsParams): array
    {
        return $this->fetch($params, 'country', AnalyticByCountry::class);
    }

    /**
     * @return AbstractAnalytic[]
     * @throws InvalidOptionalArgumentException
     */
    protected function fetch(AnalyticsParams $params, string $groupBy, string $class): array
    {
        $this->validate($params);

        $arr = $this->client->get(
            'analytics',
            array_merge($params->toArray(), ['group_by' => $groupBy])
        );
        return array_map(static fn($value) => new $class($value), $arr);
    }

    /**
     * @param AnalyticsParams $params
     * @throws InvalidOptionalArgumentException
     */
    public function validate($params): void
    {
        (new AnalyticsValidator($params))->validate();
    }

    /**
     * @return AnalyticByDate[]
     * @throws InvalidOptionalArgumentException
     */
    public function byDate(AnalyticsParams $params = new AnalyticsParams): array
    {
        return $this->fetch($params, 'date', AnalyticByDate::class);
    }

    /**
     * @return AnalyticByLabel[]
     * @throws InvalidOptionalArgumentException
     */
    public function byLabel(AnalyticsParams $params = new AnalyticsParams): array
    {
        return $this->fetch($params, 'label', AnalyticByLabel::class);
    }

    /**
     * @return AnalyticBySubaccount[]
     * @throws InvalidOptionalArgumentException
     */
    public function bySubaccount(AnalyticsParams $params = new AnalyticsParams): array
    {
        return $this->fetch($params, 'subaccount', AnalyticBySubaccount::class);
    }
}
