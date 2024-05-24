<?php declare(strict_types=1);

namespace Seven\Api\Resource\Groups;

use Seven\Api\Library\ParamsInterface;

class ListParams implements ParamsInterface
{
    protected ?int $limit = null;
    protected ?int $offset = null;

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }
}
