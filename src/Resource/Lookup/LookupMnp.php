<?php declare(strict_types=1);

namespace Seven\Api\Resource\Lookup;

class LookupMnp {
    protected int $code;
    protected Mnp $mnp;
    protected int|float $price;
    protected bool $success;

    public function __construct(object $data) {
        $this->code = (int)$data->code;
        $this->mnp = new Mnp($data->mnp);
        $this->price = is_int($data->price) ? $data->price : (float)$data->price;
        $this->success = (bool)$data->success;
    }

    public function getCode(): int {
        return $this->code;
    }

    public function getMnp(): Mnp {
        return $this->mnp;
    }

    public function getPrice() {
        return $this->price;
    }

    public function isSuccess(): bool {
        return $this->success;
    }
}

