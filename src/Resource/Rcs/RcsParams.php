<?php declare(strict_types=1);

namespace Seven\Api\Resource\Rcs;

use DateTime;
use Seven\Api\Library\ParamsInterface;

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
    protected RcsFallbackType|RcsFallbackParams|null $fallback = null;
    protected ?RcsCarouselParams $carousel = null;
    protected ?RcsRichcardParams $richcard = null;
    protected ?RcsFileParams $file = null;
    /** @var RcsSuggestionParams[]|null */
    protected ?array $suggestions = null;

    public function __construct(string $text, string $to)
    {
        $this->text = $text;
        $this->to = $to;
    }

    public static function carousel(RcsCarouselParams $carousel, string $to): self
    {
        return (new self('', $to))->setCarousel($carousel);
    }

    public static function richcard(RcsRichcardParams $richcard, string $to): self
    {
        return (new self('', $to))->setRichcard($richcard);
    }

    public static function file(RcsFileParams $file, string $to): self
    {
        return (new self('', $to))->setFile($file);
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

        if ($this->delay) {
            $arr['delay'] = $this->delay->format('Y-m-d h:i');
        }

        if ($this->fallback instanceof RcsFallbackType) {
            $arr['fallback'] = $this->fallback->value;
        }

        if ($this->fallback instanceof RcsFallbackParams) {
            $arr['fallback'] = $this->fallback->toArray();
        }

        if ($this->carousel) {
            $arr['carousel'] = $this->carousel->toArray();
        }

        if ($this->richcard) {
            $arr['richcard'] = $this->richcard->toArray();
        }

        if ($this->file) {
            $arr['file'] = $this->file->toArray();
        }

        if (is_array($this->suggestions)) {
            $arr['suggestions'] = array_map(fn(RcsSuggestionParams $v) => $v->toArray(), $this->suggestions);
        }

        if ('' === $this->text) {
            unset($arr['text']);
        }

        return $arr;
    }

    public function getFallback(): RcsFallbackType|RcsFallbackParams|null {
        return $this->fallback;
    }

    public function setFallback(RcsFallbackType|RcsFallbackParams|null $fallback): self {
        $this->fallback = $fallback;
        return $this;
    }

    public function getCarousel(): ?RcsCarouselParams
    {
        return $this->carousel;
    }

    public function setCarousel(?RcsCarouselParams $carousel): self
    {
        $this->carousel = $carousel;
        return $this;
    }

    public function getRichcard(): ?RcsRichcardParams
    {
        return $this->richcard;
    }

    public function setRichcard(?RcsRichcardParams $richcard): self
    {
        $this->richcard = $richcard;
        return $this;
    }

    public function getFile(): ?RcsFileParams
    {
        return $this->file;
    }

    public function setFile(?RcsFileParams $file): self
    {
        $this->file = $file;
        return $this;
    }

    public function getSuggestions(): ?array
    {
        return $this->suggestions;
    }

    public function setSuggestions(RcsSuggestionParams ...$suggestions): self
    {
        $this->suggestions = $suggestions;
        return $this;
    }
}
