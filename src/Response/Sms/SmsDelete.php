<?php declare(strict_types=1);

namespace Seven\Api\Response\Sms;

class SmsDelete {
    /**
     * @var string[]|null
     */
    protected ?array $deleted;
    protected bool $success;

    public function __construct(object $data) {
        $this->deleted = $data->deleted;
        $this->success = $data->success;
    }

    public function getDeleted(): ?array {
        return $this->deleted;
    }

    public function isSuccess(): bool {
        return $this->success;
    }
}
