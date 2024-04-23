<?php declare(strict_types=1);

namespace Seven\Api\Response\Groups;

class GroupDelete
{
    protected bool $success;

    public function __construct(object $obj)
    {
        $this->success = $obj->success;
    }

    public function getSuccess(): bool
    {
        return $this->success;
    }
}
