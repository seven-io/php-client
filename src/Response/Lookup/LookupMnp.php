<?php declare(strict_types=1);

namespace Seven\Api\Response\Lookup;

class LookupMnp
{
    protected int $code;
    protected Mnp $mnp;
    protected int|float $price;
    protected bool $success;

    public function __construct(object $data)
    {
        $this->code = $data->code;
        $this->mnp = new Mnp($data->mnp);
        $this->price = $data->price;
        $this->success = $data->success;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getMnp(): Mnp
    {
        return $this->mnp;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }
}

