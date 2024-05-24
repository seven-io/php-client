<?php declare(strict_types=1);

namespace Seven\Api\Resource\Contacts;

use Seven\Api\Library\OrderDirection;
use Seven\Api\Library\ParamsInterface;


class ListParams implements ParamsInterface
{
    protected ?int $groupId = null;
    protected ?int $limit = null;
    protected ?int $offset = null;
    protected ?string $orderBy = null;
    protected ?OrderDirection $orderDirection = null;
    protected ?string $search = null;

    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    public function setGroupId(?int $groupId): self
    {
        $this->groupId = $groupId;
        return $this;
    }

    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }

    public function setOrderBy(?string $orderBy): self
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    public function getOrderDirection(): ?OrderDirection
    {
        return $this->orderDirection;
    }

    public function setOrderDirection(?OrderDirection $orderDirection): self
    {
        $this->orderDirection = $orderDirection;
        return $this;
    }

    public function getSearch(): ?string
    {
        return $this->search;
    }

    public function setSearch(?string $search): self
    {
        $this->search = $search;
        return $this;
    }

    public function toArray(): array
    {
        $arr = get_object_vars($this);
        $arr['group_id'] = $this->groupId;
        $arr['order_by'] = $this->orderBy;
        $arr['order_direction'] = $this->orderDirection;

        unset($arr['groupId'], $arr['orderBy'], $arr['orderDirection']);

        return $arr;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function setOffset(int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }
}
