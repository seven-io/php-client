<?php

namespace Seven\Api\Resource;

use Seven\Api\Constant\AnalyticsGroupBy;
use Seven\Api\Exception\InvalidOptionalArgumentException;
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
     * @throws InvalidOptionalArgumentException
     */
    public function byCountry(AnalyticsParams $params = null): array {
        return $this->fetch($params ?? new AnalyticsParams, AnalyticsGroupBy::COUNTRY);
    }

    /**
     * @return AbstractAnalytic[]
     * @throws InvalidOptionalArgumentException
     */
    protected function fetch(AnalyticsParams $params, string $groupBy): array {
        $this->validate($params);

        switch ($groupBy) {
            case AnalyticsGroupBy::COUNTRY:
                $class = AnalyticByCountry::class;
                break;
            case AnalyticsGroupBy::LABEL:
                $class = AnalyticByLabel::class;
                break;
            case AnalyticsGroupBy::SUBACCOUNT:
                $class = AnalyticBySubaccount::class;
                break;
            default:
                $class = AnalyticByDate::class;
        }

        $arr = $this->client->get(
            'analytics',
            array_merge($params->toArray(), ['group_by' => $groupBy])
        );
        return array_map(static function ($value) use ($class) {
            return new $class($value);
        }, $arr);
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
     * @throws InvalidOptionalArgumentException
     */
    public function byDate(AnalyticsParams $params = null): array {
        return $this->fetch($params ?? new AnalyticsParams, AnalyticsGroupBy::DATE);
    }

    /**
     * @return AnalyticByLabel[]
     * @throws InvalidOptionalArgumentException
     */
    public function byLabel(AnalyticsParams $params = null): array {
        return $this->fetch($params ?? new AnalyticsParams, AnalyticsGroupBy::LABEL);
    }

    /**
     * @return AnalyticBySubaccount[]
     * @throws InvalidOptionalArgumentException
     */
    public function bySubaccount(AnalyticsParams $params = null): array {
        return $this->fetch($params ?? new AnalyticsParams, AnalyticsGroupBy::SUBACCOUNT);
    }
}
