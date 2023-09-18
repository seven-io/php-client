<?php declare(strict_types=1);

namespace Seven\Api\Response\Pricing;

class Country {
    protected string $countryCode;
    protected string $countryName;
    protected string $countryPrefix;
    /**
     * @var Network[] $networks
     */
    protected array $networks;

    public function __construct(object $data) {
        $this->countryCode = $data->countryCode;
        $this->countryName = $data->countryName;
        $this->countryPrefix = $data->countryPrefix;
        foreach ($data->networks as $k => $network) $this->networks[$k] = new Network($network);
    }

    public function getCountryCode(): string {
        return $this->countryCode;
    }

    public function getCountryName(): string {
        return $this->countryName;
    }

    public function getCountryPrefix(): string {
        return $this->countryPrefix;
    }

    public function getNetworks(): array {
        return $this->networks;
    }
}
