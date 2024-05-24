<?php declare(strict_types=1);

namespace Seven\Api\Resource\Lookup;

class Carrier {
    protected string $country;
    protected ?string $name;
    protected string $networkCode;
    protected ?string $networkType;

    public function __construct(object $data) {
        $this->country = $data->country;
        $this->name = $data->name;
        $this->networkCode = $data->network_code;
        $this->networkType = $data->network_type;
    }

    public function getCountry(): string {
        return $this->country;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function getNetworkCode(): string {
        return $this->networkCode;
    }

    public function getNetworkType(): ?string {
        return $this->networkType;
    }

}
