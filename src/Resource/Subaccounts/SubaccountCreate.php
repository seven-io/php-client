<?php declare(strict_types=1);

namespace Seven\Api\Resource\Subaccounts;

readonly class SubaccountCreate {
    protected ?string $error;
    protected ?Subaccount $subaccount;
    protected bool $success;

    public function __construct(object $data) {
        $this->error = $data->error !== null ? (string)$data->error : null;
        $this->subaccount = $data->subaccount ? new Subaccount($data->subaccount) : null;
        $this->success = $data->success === 'true' || $data->success === true;
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
