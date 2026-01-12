<?php

namespace Seven\Api\Library;

readonly class PagingMetadata {
    protected int $count;
    protected bool $hasMore;
    protected int $limit;
    protected int $offset;

    public function __construct(object $data) {
        $this->count = (int)$data->count;
        $this->hasMore = $data->has_more === 'true' || $data->has_more === true;
        $this->limit = (int)$data->limit;
        $this->offset = (int)$data->offset;
    }

    public function getCount(): int {
        return $this->count;
    }

    public function isHasMore(): bool {
        return $this->hasMore;
    }

    public function getLimit(): int {
        return $this->limit;
    }

    public function getOffset(): int {
        return $this->offset;
    }
}