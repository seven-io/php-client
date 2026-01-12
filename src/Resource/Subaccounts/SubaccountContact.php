<?php declare(strict_types=1);

namespace Seven\Api\Resource\Subaccounts;

readonly class SubaccountContact {
    protected string $email;
    protected string $name;

    public function __construct(object $data) {
        $this->email = (string)$data->email;
        $this->name = (string)$data->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getName(): string {
        return $this->name;
    }
}
