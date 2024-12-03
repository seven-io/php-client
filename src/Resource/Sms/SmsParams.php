<?php declare(strict_types=1);

namespace Seven\Api\Resource\Sms;

use DateTime;
use Seven\Api\Library\ParamsInterface;

class SmsParams implements ParamsInterface
{
    protected ?DateTime $delay = null;
    protected array $files = [];
    protected ?bool $flash = null;
    protected ?string $foreign_id = null;
    protected ?string $from = null;
    protected ?string $label = null;
    protected ?bool $performance_tracking = null;
    protected string $text;
    protected array $to = [];
    protected ?int $ttl = null;
    protected ?string $udh = null;

    public function __construct(string $text, string ...$to)
    {
        $this->text = $text;
        $this->to = $to;
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

    public function addFile(array $file): self
    {
        $this->files[] = $file;
        return $this;
    }

    public function getFiles(): array
    {
        return $this->files;
    }

    public function setFiles(array $files): self
    {
        $this->files = $files;
        return $this;
    }

    public function removeFile(int $index): self
    {
        unset($this->files[$index]);
        return $this;
    }

    public function removeFiles(): self
    {
        $this->files = [];
        return $this;
    }

    public function getFlash(): ?bool
    {
        return $this->flash;
    }

    public function setFlash(?bool $flash): self
    {
        $this->flash = $flash;
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

    public function addTo(string ...$to): self
    {
        $this->to = [...$this->to, ...$to];
        return $this;
    }

    public function getTo(): array
    {
        return $this->to;
    }

    public function setTo(array $to): self
    {
        $this->to = $to;
        return $this;
    }

    public function getTtl(): ?int
    {
        return $this->ttl;
    }

    public function setTtl(?int $ttl): self
    {
        $this->ttl = $ttl;
        return $this;
    }

    public function getUdh(): ?string
    {
        return $this->udh;
    }

    public function setUdh(?string $udh): self
    {
        $this->udh = $udh;
        return $this;
    }

    public function toArray(): array
    {
        $arr = get_object_vars($this);
        $arr['to'] = implode(',', $this->to);

        if ($this->delay) $arr['delay'] = $this->delay->format('Y-m-d h:i');

        return $arr;
    }
}
