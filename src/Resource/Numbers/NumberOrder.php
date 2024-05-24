<?php declare(strict_types=1);

namespace Seven\Api\Resource\Numbers;

readonly class NumberOrder {
    protected ?string $error;
    protected bool $success;

    public function __construct(object $obj) {
        $this->error = $obj->error;
        $this->success = $obj->success;
    }

    public function getError(): ?string {
        return $this->error;
    }

    public function isSuccess(): bool {
        return $this->success;
    }
}
