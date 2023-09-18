<?php declare(strict_types=1);

namespace Seven\Api\Response\Subaccounts;

class SubaccountCreate {
    protected ?string $error;
    protected ?Subaccount $subaccount;
    protected bool $success;

    public function __construct(object $data) {
        $this->error = $data->error;
        $this->subaccount = $data->subaccount ? new Subaccount($data->subaccount) : null;
        $this->success = $data->success;
    }

    public function getError(): ?string {
        return $this->error;
    }

    public function getSubaccount(): ?Subaccount {
        return $this->subaccount;
    }

    public function isSuccess(): bool {
        return $this->success;
    }
}
