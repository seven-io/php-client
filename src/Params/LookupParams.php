<?php declare(strict_types=1);

namespace Seven\Api\Params;

class LookupParams implements ParamsInterface {
    protected array $numbers;
    protected ?bool $json = null;
    protected string $type;

    public function __construct(string $type, string ...$numbers) {
        $this->type = $type;
        $this->numbers = $numbers;
    }

    public function getNumbers(): array {
        return $this->numbers;
    }

    public function setNumbers(array $numbers): self {
        $this->numbers = $numbers;
        return $this;
    }

    public function getType(): string {
        return $this->type;
    }

    public function setType(string $type): self {
        $this->type = $type;
        return $this;
    }

    public function toArray(): array {
        $arr = get_object_vars($this);

        $arr['number'] = implode(',', $arr['numbers']);
        unset($arr['numbers']);

        return $arr;
    }

    public function getJson(): ?bool {
        return $this->json;
    }

    public function setJson(?bool $json): self {
        $this->json = $json;
        return $this;
    }
}
