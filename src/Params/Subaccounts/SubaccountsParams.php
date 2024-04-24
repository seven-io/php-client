<?php declare(strict_types=1);

namespace Seven\Api\Params\Subaccounts;

use Seven\Api\Params\ParamsInterface;

class SubaccountsParams implements ParamsInterface
{
    protected string $action;
    protected ?float $amount = null;
    protected ?int $id = null;
    protected ?string $email = null;
    protected ?string $name = null;
    protected ?float $threshold = null;

    public function __construct(string $action)
    {
        $this->action = $action;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function setAction(string $action): self
    {
        $this->action = $action;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->action;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function getThreshold(): ?float
    {
        return $this->threshold;
    }

    public function setThreshold(?float $threshold): self
    {
        $this->threshold = $threshold;
        return $this;
    }
}
