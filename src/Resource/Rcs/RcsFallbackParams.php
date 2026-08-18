<?php declare(strict_types=1);

namespace Seven\Api\Resource\Rcs;

use Seven\Api\Library\ParamsInterface;

class RcsFallbackParams implements ParamsInterface
{
    protected ?string $text = null;
    protected ?string $from = null;

    public function __construct(protected RcsFallbackType $type)
    {
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type->value,
            'text' => $this->text,
            'from' => $this->from,
        ];
    }

    public function getType(): RcsFallbackType
    {
        return $this->type;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;
        return $this;
    }

    public function getFrom(): ?string
    {
        return $this->from;
    }

    public function setFrom(?string $from): self
    {
        $this->from = $from;
        return $this;
    }
}
