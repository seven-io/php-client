<?php declare(strict_types=1);

namespace Seven\Api\Resource\Rcs;

class RcsEventDispatched {
    protected bool $success;

    public function __construct(object $data) {
        $this->success = $data->success === 'true' || $data->success === true;
    }

    public function isSuccess(): bool {
        return $this->success;
    }
}
