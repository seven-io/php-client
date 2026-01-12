<?php declare(strict_types=1);

namespace Seven\Api\Resource\Lookup;

class Mnp {
    protected string $country;
    protected string $internationalFormatted;
    protected ?bool $isPorted;
    protected string $mccMnc;
    protected string $nationalFormat;
    protected ?string $network;
    protected ?string $networkType;
    protected string $number;

    public function __construct(object $data) {
        $this->country = (string)$data->country;
        $this->internationalFormatted = (string)$data->international_formatted;
        $this->isPorted = $data->isPorted !== null ? (bool)$data->isPorted : null;
        $this->mccMnc = (string)$data->mccmnc;
        $this->nationalFormat = (string)$data->national_format;
        $this->network = $data->network !== null ? (string)$data->network : null;
        $this->networkType = $data->network_type !== null ? (string)$data->network_type : null;
        $this->number = (string)$data->number;
    }

    public function getCountry(): string {
        return $this->country;
    }

    public function getInternationalFormatted(): string {
        return $this->internationalFormatted;
    }

    public function isPorted(): ?bool {
        return $this->isPorted;
    }

    public function getMccMnc(): string {
        return $this->mccMnc;
    }

    public function getNationalFormat(): string {
        return $this->nationalFormat;
    }

    public function getNetwork(): ?string {
        return $this->network;
    }

    public function getNetworkType(): ?string {
        return $this->networkType;
    }

    public function getNumber(): string {
        return $this->number;
    }
}
