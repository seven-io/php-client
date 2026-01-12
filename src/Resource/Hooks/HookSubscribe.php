<?php declare(strict_types=1);

namespace Seven\Api\Resource\Hooks;

class HookSubscribe {
    protected ?int $id;
    protected bool $success;

    public function __construct(object $data) {
        $this->id = $data->id !== null ? (int)$data->id : null;
        $this->success = $data->success === 'true' || $data->success === true;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function isSuccess(): bool {
        return $this->success;
    }
}
