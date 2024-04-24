<?php declare(strict_types=1);

namespace Seven\Api\Params;

class PricingParams implements ParamsInterface
{
    protected ?string $country = null;

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;
        return $this;
    }
}
