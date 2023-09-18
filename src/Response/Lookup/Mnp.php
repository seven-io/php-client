<?php declare(strict_types=1);

namespace Seven\Api\Response\Lookup;

class Mnp {
    protected string $country;
    protected string $internationalFormatted;
    protected bool $isPorted;
    protected string $mccMnc;
    protected string $nationalFormat;
    protected string $network;
    protected string $number;

    public function __construct(object $data) {
        $this->country = $data->country;
        $this->internationalFormatted = $data->international_formatted;
        $this->isPorted = $data->isPorted;
        $this->mccMnc = $data->mccmnc;
        $this->nationalFormat = $data->national_format;
        $this->network = $data->network;
        $this->number = $data->number;
    }

    public function getCountry(): string {
        return $this->country;
    }

    public function getInternationalFormatted(): string {
        return $this->internationalFormatted;
    }

    public function isPorted(): bool {
        return $this->isPorted;
    }

    public function getMccMnc(): string {
        return $this->mccMnc;
    }

    public function getNationalFormat(): string {
        return $this->nationalFormat;
    }

    public function getNetwork(): string {
        return $this->network;
    }

    public function getNumber(): string {
        return $this->number;
    }
}
