<?php declare(strict_types=1);

namespace Seven\Api\Resource\Lookup;

class LookupCnam {
    protected string|int $code;
    protected ?string $name = null;
    protected ?string $number = null;
    protected ?bool $success = null;

    public function __construct(object $data) {
        $this->code = is_string($data->code) ? $data->code : (int)$data->code;

        if (is_string($data->code)) {
            $this->name = $data->name !== null ? (string)$data->name : null;
            $this->number = $data->number !== null ? (string)$data->number : null;
            $this->success = $data->success === 'true' || $data->success === true;
        }
    }

    public function getCode(): string|int {
        return $this->code;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function getNumber(): ?string {
        return $this->number;
    }

    public function isSuccess(): ?bool {
        return $this->success;
    }
}
