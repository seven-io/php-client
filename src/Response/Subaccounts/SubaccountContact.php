<?php declare(strict_types=1);

namespace Seven\Api\Response\Subaccounts;

class SubaccountContact {
    protected string $email;
    protected string $name;

    public function __construct(object $data) {
        $this->email = $data->email;
        $this->name = $data->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getName(): string {
        return $this->name;
    }
}
