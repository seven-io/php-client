<?php declare(strict_types=1);

namespace Seven\Api\Resource\Rcs;

use Seven\Api\Library\ParamsInterface;

class RcsFileParams implements ParamsInterface
{
    protected ?RcsFileHeight $height = null;
    protected ?string $fileUrl = null;
    protected ?string $fileContents = null;
    protected ?string $thumbnailUrl = null;
    protected ?string $thumbnailContents = null;

    public function toArray(): array
    {
        $arr = get_object_vars($this);

        if ($this->height) {
            $arr['height'] = $this->height->value;
        }

        return $arr;
    }

    public function getHeight(): ?RcsFileHeight
    {
        return $this->height;
    }

    public function setHeight(?RcsFileHeight $height): self
    {
        $this->height = $height;
        return $this;
    }

    public function getFileUrl(): ?string
    {
        return $this->fileUrl;
    }

    public function setFileUrl(?string $fileUrl): self
    {
        $this->fileUrl = $fileUrl;
        return $this;
    }

    public function getFileContents(): ?string
    {
        return $this->fileContents;
    }

    public function setFileContents(?string $fileContents): self
    {
        $this->fileContents = $fileContents;
        return $this;
    }

    public function getThumbnailUrl(): ?string
    {
        return $this->thumbnailUrl;
    }

    public function setThumbnailUrl(?string $thumbnailUrl): self
    {
        $this->thumbnailUrl = $thumbnailUrl;
        return $this;
    }

    public function getThumbnailContents(): ?string
    {
        return $this->thumbnailContents;
    }

    public function setThumbnailContents(?string $thumbnailContents): self
    {
        $this->thumbnailContents = $thumbnailContents;
        return $this;
    }
}
