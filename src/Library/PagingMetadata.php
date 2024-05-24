<?php

namespace Seven\Api\Library;

readonly class PagingMetadata {
    protected int $count;
    protected bool $hasMore;
    protected int $limit;
    protected int $offset;

    public function __construct(object $data) {
        $this->count = $data->count;
        $this->hasMore = $data->has_more;
        $this->limit = $data->limit;
        $this->offset = $data->offset;
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