<?php declare(strict_types=1);

namespace Seven\Api\Resource\Sms;

class SmsDelete {
    /**
     * @var string[]|null
     */
    protected ?array $deleted;
    protected bool $success;

    public function __construct(object $data) {
        $this->deleted = $data->deleted !== null ? (array)$data->deleted : null;
        $this->success = $data->success === 'true' || $data->success === true;
    }

    public function getDeleted(): ?array {
        return $this->deleted;
    }

    public function isSuccess(): bool {
        return $this->success;
    }
}
