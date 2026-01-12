<?php declare(strict_types=1);

namespace Seven\Api\Resource\Numbers;

readonly class PhoneNumberOffer {
    protected string $country;
    protected PhoneNumberFeatures $features;
    protected PhoneNumberOfferFees $fees;
    protected string $number;
    protected string $numberParsed;

    public function __construct(object $data) {
        $this->country = (string)$data->country;
        $this->features = new PhoneNumberFeatures($data->features);
        $this->fees = new PhoneNumberOfferFees($data->fees);
        $this->number = (string)$data->number;
        $this->numberParsed = (string)$data->number_parsed;
    }

    public function getCountry(): string {
        return $this->country;
    }

    public function getFeatures(): PhoneNumberFeatures {
        return $this->features;
    }

    public function getFees(): PhoneNumberOfferFees {
        return $this->fees;
    }

    public function getNumber(): string {
        return $this->number;
    }

    public function getNumberParsed(): string {
        return $this->numberParsed;
    }
}
