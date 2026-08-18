<?php declare(strict_types=1);

namespace Seven\Api\Resource\Rcs;

use Seven\Api\Library\ParamsInterface;

class RcsRichcardParams implements ParamsInterface
{
    protected ?RcsCardOrientation $orientation = null;
    protected ?RcsThumbnailImageAlignment $thumbnailImageAlignment = null;
    protected ?RcsFileParams $file = null;
    /** @var RcsSuggestionParams[]|null */
    protected ?array $suggestions = null;

    public function __construct(
        protected string $title,
        protected string $description,
    ) {
    }

    public function toArray(): array
    {
        $arr = get_object_vars($this);

        if ($this->orientation) {
            $arr['orientation'] = $this->orientation->value;
        }

        if ($this->thumbnailImageAlignment) {
            $arr['thumbnailImageAlignment'] = $this->thumbnailImageAlignment->value;
        }

        if ($this->file) {
            $arr['file'] = $this->file->toArray();
        }

        if (is_array($this->suggestions)) {
            $arr['suggestions'] = array_map(fn(RcsSuggestionParams $v) => $v->toArray(), $this->suggestions);
        }

        return $arr;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getOrientation(): ?RcsCardOrientation
    {
        return $this->orientation;
    }

    public function setOrientation(?RcsCardOrientation $orientation): self
    {
        $this->orientation = $orientation;
        return $this;
    }

    public function getThumbnailImageAlignment(): ?RcsThumbnailImageAlignment
    {
        return $this->thumbnailImageAlignment;
    }

    public function setThumbnailImageAlignment(?RcsThumbnailImageAlignment $thumbnailImageAlignment): self
    {
        $this->thumbnailImageAlignment = $thumbnailImageAlignment;
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
