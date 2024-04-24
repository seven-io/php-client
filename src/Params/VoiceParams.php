<?php declare(strict_types=1);

namespace Seven\Api\Params;

class VoiceParams implements ParamsInterface
{
    protected ?string $from = null;
    protected ?int $ringtime = null;

    public function __construct(protected string $text, protected string $to)
    {
    }

    public function toArray(): array
    {
        return get_object_vars($this);
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

    public function getRingtime(): ?int
    {
        return $this->ringtime;
    }

    public function setRingtime(?int $ringtime): self
    {
        $this->ringtime = $ringtime;
        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function setTo(string $to): self
    {
        $this->to = $to;
        return $this;
    }
}
