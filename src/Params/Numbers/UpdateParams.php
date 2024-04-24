<?php declare(strict_types=1);

namespace Seven\Api\Params\Numbers;

use Seven\Api\Params\ParamsInterface;

class UpdateParams implements ParamsInterface
{
    protected ?array $emailForward = null;
    protected ?string $friendlyName = null;
    protected ?array $smsForward = null;

    public function __construct(protected string $number)
    {
    }

    public function getEmailForward(): ?array
    {
        return $this->emailForward;
    }

    public function setEmailForward(?array $emailForward): UpdateParams
    {
        $this->emailForward = $emailForward;
        return $this;
    }

    public function getFriendlyName(): ?string
    {
        return $this->friendlyName;
    }

    public function setFriendlyName(?string $friendlyName): UpdateParams
    {
        $this->friendlyName = $friendlyName;
        return $this;
    }

    public function getSmsForward(): ?array
    {
        return $this->smsForward;
    }

    public function setSmsForward(?array $smsForward): UpdateParams
    {
        $this->smsForward = $smsForward;
        return $this;
    }

    public function toArray(): array
    {
        $arr = get_object_vars($this);

        $arr['email_forward'] = $this->emailForward;
        $arr['friendly_name'] = $this->friendlyName;
        $arr['sms_forward'] = $this->smsForward;

        unset($arr['emailForward'], $arr['friendlyName'], $arr['smsForward'], $arr['number']);

        return $arr;
    }

    public function getNumber(): string
    {
        return $this->number;
    }
}
