<?php declare(strict_types=1);

namespace Seven\Api\Resource\Analytics;

class AnalyticByCountry extends AbstractAnalytic {
    protected string $country;

    public function __construct(object $data) {
        parent::__construct($data);

        $this->country = (string)$data->country;
    }

    public function getCountry(): string {
        return $this->country;
    }
}
