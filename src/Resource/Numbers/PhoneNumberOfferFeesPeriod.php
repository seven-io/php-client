<?php declare(strict_types=1);

namespace Seven\Api\Resource\Numbers;

readonly class PhoneNumberOfferFeesPeriod {
    protected float $basicCharge;
    protected float $setup;

    public function __construct(object $data) {
        $this->basicCharge = (float)$data->basic_charge;
        $this->setup = (float)$data->setup;
    }

    public function getBasicCharge(): float {
        return $this->basicCharge;
    }

    public function getSetup(): float {
        return $this->setup;
    }
}
