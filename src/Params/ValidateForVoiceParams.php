<?php declare(strict_types=1);

namespace Seven\Api\Params;

class ValidateForVoiceParams implements ParamsInterface {
    protected ?string $callback = null;
    protected string $number;

    public function __construct(string $number) {
        $this->number = $number;
    }

    public function toArray(): array {
        return get_object_vars($this);
    }

    public function getNumber(): string {
        return $this->number;
    }

    public function setNumber(string $number): self {
        $this->number = $number;
        return $this;
    }

    public function getCallback(): ?string {
        return $this->callback;
    }

    public function setCallback(?string $callback): self {
        $this->callback = $callback;
        return $this;
    }
}
