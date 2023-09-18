<?php declare(strict_types=1);

namespace Seven\Api\Params;

class PricingParams implements ParamsInterface {
    protected ?string $country = null;
    protected ?string $format = null;

    public function toArray(): array {
        return get_object_vars($this);
    }

    public function getCountry(): ?string {
        return $this->country;
    }

    public function setCountry(?string $country): self {
        $this->country = $country;
        return $this;
    }

    public function getFormat(): ?string {
        return $this->format;
    }

    public function setFormat(?string $format): self {
        $this->format = $format;
        return $this;
    }
}
