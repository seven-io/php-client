<?php declare(strict_types=1);

namespace Seven\Api\Response\Lookup;

class LookupFormat {
    protected string $carrier;
    protected string $countryCode;
    protected string $countryIso;
    protected string $countryName;
    protected string $international;
    protected string $internationalFormatted;
    protected string $national;
    protected string $networkType;
    protected bool $success;

    public function __construct(object $data) {
        $this->carrier = $data->carrier;
        $this->countryIso = $data->country_iso;
        $this->countryCode = $data->country_code;
        $this->countryName = $data->country_name;
        $this->international = $data->international;
        $this->internationalFormatted = $data->international_formatted;
        $this->national = $data->national;
        $this->networkType = $data->network_type;
        $this->success = $data->success;
    }

    public function getCarrier(): string {
        return $this->carrier;
    }

    public function getCountryCode(): string {
        return $this->countryCode;
    }

    public function getCountryIso(): string {
        return $this->countryIso;
    }

    public function getCountryName(): string {
        return $this->countryName;
    }

    public function getInternational(): string {
        return $this->international;
    }

    public function getInternationalFormatted(): string {
        return $this->internationalFormatted;
    }

    public function getNational(): string {
        return $this->national;
    }

    public function getNetworkType(): string {
        return $this->networkType;
    }

    public function isSuccess(): bool {
        return $this->success;
    }

}
