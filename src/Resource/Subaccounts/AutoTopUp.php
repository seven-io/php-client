<?php declare(strict_types=1);

namespace Seven\Api\Resource\Subaccounts;

readonly class AutoTopUp {
    protected ?float $amount;
    protected ?float $threshold;

    public function __construct(object $data) {
        $this->amount = $data->amount;
        $this->threshold = $data->threshold;
    }

    public function getAmount(): ?float {
        return $this->amount;
    }

    public function getThreshold(): ?float {
        return $this->threshold;
    }
}
