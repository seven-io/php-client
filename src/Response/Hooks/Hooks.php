<?php declare(strict_types=1);

namespace Seven\Api\Response\Hooks;

class Hooks {
    /**
     * @var Hook[] $hooks
     */
    protected array $hooks = [];
    protected bool $success;

    public function __construct(object $data) {
        foreach ($data->hooks as $k => $v) $this->hooks[$k] = new Hook($v);
        $this->success = $data->success;
    }

    public function getHooks(): array {
        return $this->hooks;
    }

    public function isSuccess(): bool {
        return $this->success;
    }
}
