<?php declare(strict_types=1);

namespace Seven\Api\Response;

class Balance {
    protected float $amount;
    protected string $currency;

    public function __construct(object $data) {
        $this->amount = $data->amount;
        $this->currency = $data->currency;
    }

    public function getAmount(): float {
        return $this->amount;
    }

    public function getCurrency(): string {
        return $this->currency;
    }
}
