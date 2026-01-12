<?php declare(strict_types=1);

namespace Seven\Api\Resource\Groups;

class GroupDelete {
    protected bool $success;

    public function __construct(object $obj) {
        $this->success = $obj->success === 'true' || $obj->success === true;
    }

    public function getSuccess(): bool {
        return $this->success;
    }
}
