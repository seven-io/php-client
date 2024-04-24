<?php declare(strict_types=1);

namespace Seven\Api\Response\Numbers;

readonly class NumberDeletion
{
    protected bool $success;

    public function __construct(object $obj)
    {
        $this->success = $obj->success;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }
}
