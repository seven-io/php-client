<?php declare(strict_types=1);

namespace Seven\Api\Resource\Subaccounts;

readonly class AutoTopUp {
    protected ?float $amount;
    protected ?float $threshold;

    public function __construct(object $data) {
        $this->amount = $data->amount !== null ? (float)$data->amount : null;
        $this->threshold = $data->threshold !== null ? (float)$data->threshold : null;
    }

    public function getAmount(): ?float {
        return $this->amount;
    }

    public function getThreshold(): ?float {
        return $this->threshold;
    }
}
