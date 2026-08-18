<?php declare(strict_types=1);

namespace Seven\Api\Resource\Rcs;

use Seven\Api\Library\ParamsInterface;

class RcsCarouselParams implements ParamsInterface
{
    /** @var RcsRichcardParams[] */
    protected array $richcards;

    public function __construct(
        protected RcsCarouselWidth $width,
        RcsRichcardParams ...$richcards,
    ) {
        $this->richcards = $richcards;
    }

    public function getWidth(): RcsCarouselWidth
    {
        return $this->width;
    }

    public function setWidth(RcsCarouselWidth $width): self
    {
        $this->width = $width;
        return $this;
    }

    public function getRichcards(): array
    {
        return $this->richcards;
    }

    public function addRichcards(RcsRichcardParams ...$richcards): self
    {
        array_push($this->richcards, ...$richcards);
        return $this;
    }

    public function toArray(): array
    {
        return [
            'width' => $this->width->value,
            'richcards' => array_map(fn(RcsRichcardParams $v) => $v->toArray(), $this->richcards),
        ];
    }
}
