<?php declare(strict_types=1);

namespace Seven\Api\Resource\Subaccounts;

class Subaccount {
    protected AutoTopUp $autoTopup;
    protected float $balance;
    protected ?string $company;
    protected SubaccountContact $contact;
    protected int $id;
    protected float $totalUsage;
    protected ?string $username;

    public function __construct(object $data) {
        $this->autoTopup = new AutoTopUp($data->auto_topup);
        $this->balance = (float)$data->balance;
        $this->company = $data->company !== null ? (string)$data->company : null;
        $this->contact = new SubaccountContact($data->contact);
        $this->id = (int)$data->id;
        $this->totalUsage = (float)$data->total_usage;
        $this->username = $data->username !== null ? (string)$data->username : null;
    }

    public function getAutoTopup(): object {
        return $this->autoTopup;
    }

    public function getBalance(): float {
        return $this->balance;
    }

    public function getCompany(): ?string {
        return $this->company;
    }

    public function getContact(): object {
        return $this->contact;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getTotalUsage(): float {
        return $this->totalUsage;
    }

    public function getUsername(): ?string {
        return $this->username;
    }
}
