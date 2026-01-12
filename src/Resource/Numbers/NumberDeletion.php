<?php declare(strict_types=1);

namespace Seven\Api\Resource\Numbers;

readonly class NumberDeletion {
    protected bool $success;

    public function __construct(object $obj) {
        $this->success = $obj->success === 'true' || $obj->success === true;
    }

    public function isSuccess(): bool {
        return $this->success;
    }
}
