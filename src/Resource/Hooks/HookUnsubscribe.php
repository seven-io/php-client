<?php declare(strict_types=1);

namespace Seven\Api\Resource\Hooks;

class HookUnsubscribe {
    protected bool $success;

    public function __construct(object $data) {
        $this->success = $data->success;
    }

    public function isSuccess(): bool {
        return $this->success;
    }
}
