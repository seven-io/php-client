<?php declare(strict_types=1);

namespace Seven\Api\Resource\Groups;

use Seven\Api\Library\PagingMetadata;

class ListGroups {
    /** @var Group[] $data */
    protected array $data;
    protected PagingMetadata $pagingMetadata;

    public function __construct(object $obj) {
        $this->data = array_map(fn(object $entry) => new Group($entry), $obj->data);
        $this->pagingMetadata = new PagingMetadata($obj->pagingMetadata);
    }

    public function getData(): array {
        return $this->data;
    }

    public function getPagingMetadata(): PagingMetadata {
        return $this->pagingMetadata;
    }
}
