<?php declare(strict_types=1);

namespace Seven\Api\Params\Rcs;

use DateTime;
use Seven\Api\Params\ParamsInterface;

class RcsParams implements ParamsInterface
{
    protected ?DateTime $delay = null;
    protected ?string $foreign_id = null;
    protected ?string $from = null;
    protected ?string $label = null;
    protected ?bool $performance_tracking = null;
    protected string $text;
    protected string $to;
    protected ?int $ttl = null;

    public function __construct(string $text, string $to)
    {
        $this->text = $text;
        $this->to = $to;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getDelay(): ?DateTime
    {
        return $this->delay;
    }

    public function setDelay(?DateTime $delay): self
    {
        $this->delay = $delay;
        return $this;
    }

    public function getForeignId(): ?string
    {
        return $this->foreign_id;
    }

    public function setForeignId(?string $foreignId): self
    {
        $this->foreign_id = $foreignId;
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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function getPerformanceTracking(): ?bool
    {
        return $this->performance_tracking;
    }

    public function setPerformanceTracking(?bool $performanceTracking): self
    {
        $this->performance_tracking = $performanceTracking;
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

    public function getTTL(): ?int
    {
        return $this->ttl;
    }

    public function setTTL(?int $ttl): self
    {
        $this->ttl = $ttl;
        return $this;
    }

    public function toArray(): array
    {
        $arr = get_object_vars($this);
        if ($this->delay) $arr['delay'] = $this->delay->format('Y-m-d h:i');
        return $arr;
    }
}
