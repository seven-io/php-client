<?php declare(strict_types=1);

namespace Seven\Api\Response\Subaccounts;

readonly class SubaccountAutoCharged
{
    protected ?string $error;
    protected bool $success;

    public function __construct(object $data)
    {
        $this->error = $data->error;
        $this->success = $data->success;
    }

    public function getError(): ?string
    {
        return $this->error;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }
}
