<?php declare(strict_types=1);

namespace Seven\Api\Response\Lookup;

class LookupCnam {
    protected string $code;
    protected string $name;
    protected string $number;
    protected bool $success;

    public function __construct(object $data) {
        $this->code = $data->code;
        $this->name = $data->name;
        $this->number = $data->number;
        $this->success = 'true' === $data->success;
    }

    public function getCode(): string {
        return $this->code;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getNumber(): string {
        return $this->number;
    }

    public function isSuccess(): bool {
        return $this->success;
    }
}
