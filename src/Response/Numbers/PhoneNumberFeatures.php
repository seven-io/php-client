<?php declare(strict_types=1);

namespace Seven\Api\Response\Numbers;

class PhoneNumberFeatures
{
    protected bool $applicationToPersonSms;
    protected bool $sms;
    protected bool $voice;

    public function __construct(object $data)
    {
        $this->applicationToPersonSms = $data->a2p_sms;
        $this->sms = $data->sms;
        $this->voice = $data->voice;
    }

    public function isApplicationToPersonSms(): bool
    {
        return $this->applicationToPersonSms;
    }

    public function setApplicationToPersonSms(bool $applicationToPersonSms): PhoneNumberFeatures
    {
        $this->applicationToPersonSms = $applicationToPersonSms;
        return $this;
    }

    public function isSms(): bool
    {
        return $this->sms;
    }

    public function setSms(bool $sms): PhoneNumberFeatures
    {
        $this->sms = $sms;
        return $this;
    }

    public function isVoice(): bool
    {
        return $this->voice;
    }

    public function setVoice(bool $voice): PhoneNumberFeatures
    {
        $this->voice = $voice;
        return $this;
    }
}
