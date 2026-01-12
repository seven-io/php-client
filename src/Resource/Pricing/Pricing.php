<?php declare(strict_types=1);

namespace Seven\Api\Resource\Pricing;

class Pricing {
    protected int $countCountries;
    protected int $countNetworks;
    /**
     * @var Country[] $countries
     */
    protected array $countries;

    public function __construct(object $data) {
        $this->countCountries = (int)$data->countCountries;
        $this->countNetworks = (int)$data->countNetworks;
        foreach ($data->countries as $k => $country) $this->countries[$k] = new Country($country);
    }

    public function getCountCountries(): int {
        return $this->countCountries;
    }

    public function getCountNetworks(): int {
        return $this->countNetworks;
    }

    public function getCountries(): array {
        return $this->countries;
    }
}
