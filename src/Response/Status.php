<?php declare(strict_types=1);

namespace Seven\Api\Response;

use DateTime;

class Status {
    protected int $id;
    protected ?DateTime $statusTime;
    protected ?string $status;

    public function __construct(object $data) {
        $this->id = (int)$data->id;
        $this->status = $data->status;
        $this->statusTime = $data->status_time ? new DateTime($data->status_time) : null;
    }

    public function getStatusTime(): ?DateTime {
        return $this->statusTime;
    }

    public function getStatus(): ?string {
        return $this->status;
    }

    public function getId(): int {
        return $this->id;
    }
}
