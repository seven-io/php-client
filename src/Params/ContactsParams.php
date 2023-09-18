<?php declare(strict_types=1);

namespace Seven\Api\Params;

class ContactsParams implements ParamsInterface {
    protected string $action;
    protected ?string $email = null;
    protected ?int $id = null;
    protected ?string $mobile = null;
    protected ?string $nick = null;

    public function __construct(string $action) {
        $this->action = $action;
    }

    public function getAction(): string {
        return $this->action;
    }

    public function setAction(string $action): self {
        $this->action = $action;
        return $this;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getNick(): ?string {
        return $this->nick;
    }

    public function setNick(?string $nick): self {
        $this->nick = $nick;
        return $this;
    }

    public function getMobile(): ?string {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): self {
        $this->mobile = $mobile;
        return $this;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $email): self {
        $this->email = $email;
        return $this;
    }

    public function toArray(): array {
        $arr = get_object_vars($this);
        $arr = array_merge($arr, [
            'empfaenger' => $arr['mobile'],
            'json' => true,
        ]);
        unset($arr['mobile']);
        return $arr;
    }
}
