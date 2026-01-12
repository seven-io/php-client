<?php declare(strict_types=1);

namespace Seven\Api\Resource\Lookup;

class LookupFormat {
    protected ?string $carrier;
    protected string|false $countryCode;
    protected ?string $countryIso;
    protected ?string $countryName;
    protected string $international;
    protected string $internationalFormatted;
    protected ?string $national;
    protected ?string $networkType;
    protected bool $success;

    public function __construct(object $data) {
        $this->carrier = $data->carrier !== null ? (string)$data->carrier : null;
        $this->countryIso = $data->country_iso !== null ? (string)$data->country_iso : null;
        $this->countryCode = $data->country_code !== false ? (string)$data->country_code : false;
        $this->countryName = $data->country_name !== null ? (string)$data->country_name : null;
        $this->international = (string)$data->international;
        $this->internationalFormatted = (string)$data->international_formatted;
        $this->national = $data->national !== null ? (string)$data->national : null;
        $this->networkType = $data->network_type !== null ? (string)$data->network_type : null;
        $this->success = (bool)$data->success;
    }

    public function getCarrier(): ?string {
        return $this->carrier;
    }

    public function getCountryCode(): string|false {
        return $this->countryCode;
    }

    public function getCountryIso(): ?string {
        return $this->countryIso;
    }

    public function getCountryName(): ?string {
        return $this->countryName;
    }

    public function getInternational(): string {
        return $this->international;
    }

    public function getInternationalFormatted(): string {
        return $this->internationalFormatted;
    }

    public function getNational(): ?string {
        return $this->national;
    }

    public function getNetworkType(): ?string {
        return $this->networkType;
    }

    public function isSuccess(): bool {
        return $this->success;
    }

}
