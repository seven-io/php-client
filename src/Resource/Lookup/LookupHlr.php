<?php declare(strict_types=1);

namespace Seven\Api\Resource\Lookup;

class LookupHlr {
    protected ?string $countryCode;
    protected ?string $countryName;
    protected string|false $countryPrefix;
    protected Carrier $currentCarrier;
    protected ?int $gsmCode;
    protected ?string $gsmMessage;
    protected string $internationalFormatNumber;
    protected string $internationalFormatted;
    protected bool $lookupOutcome;
    protected string $lookupOutcomeMessage;
    protected string $nationalFormatNumber;
    protected Carrier $originalCarrier;
    protected string $ported;
    protected string $reachable;
    protected string $roaming;
    protected bool $status;
    protected string $statusMessage;
    protected string $validNumber;

    public function __construct(object $data) {
        $this->countryCode = $data->country_code ? (string)$data->country_code : null;
        $this->countryName = $data->country_name !== null ? (string)$data->country_name : null;
        $this->countryPrefix = $data->country_prefix !== false ? (string)$data->country_prefix : false;
        $this->currentCarrier = new Carrier($data->current_carrier);
        $this->gsmCode = $data->gsm_code !== null ? (int)$data->gsm_code : null;
        $this->gsmMessage = $data->gsm_message !== null ? (string)$data->gsm_message : null;
        $this->internationalFormatNumber = (string)$data->international_format_number;
        $this->internationalFormatted = (string)$data->international_formatted;
        $this->lookupOutcome = (bool)$data->lookup_outcome;
        $this->lookupOutcomeMessage = (string)$data->lookup_outcome_message;
        $this->nationalFormatNumber = (string)$data->national_format_number;
        $this->originalCarrier = new Carrier($data->original_carrier);
        $this->ported = (string)$data->ported;
        $this->reachable = (string)$data->reachable;
        $this->roaming = (string)$data->roaming;
        $this->status = (bool)$data->status;
        $this->statusMessage = (string)$data->status_message;
        $this->validNumber = (string)$data->valid_number;
    }

    public function getCountryCode(): ?string {
        return $this->countryCode;
    }

    public function getCountryName(): ?string {
        return $this->countryName;
    }

    public function getCountryPrefix(): string|false {
        return $this->countryPrefix;
    }

    public function getCurrentCarrier(): Carrier {
        return $this->currentCarrier;
    }

    public function getGsmCode(): ?int {
        return $this->gsmCode;
    }

    public function getGsmMessage(): ?string {
        return $this->gsmMessage;
    }

    public function getInternationalFormatNumber(): string {
        return $this->internationalFormatNumber;
    }

    public function getInternationalFormatted(): string {
        return $this->internationalFormatted;
    }

    public function isLookupOutcome(): bool {
        return $this->lookupOutcome;
    }

    public function getLookupOutcomeMessage(): string {
        return $this->lookupOutcomeMessage;
    }

    public function getNationalFormatNumber(): string {
        return $this->nationalFormatNumber;
    }

    public function getOriginalCarrier(): Carrier {
        return $this->originalCarrier;
    }

    public function getPorted(): string {
        return $this->ported;
    }

    public function getReachable(): string {
        return $this->reachable;
    }

    public function getRoaming(): string {
        return $this->roaming;
    }

    public function isStatus(): bool {
        return $this->status;
    }

    public function getStatusMessage(): string {
        return $this->statusMessage;
    }

    public function getValidNumber(): string {
        return $this->validNumber;
    }
}
