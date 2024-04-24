<?php declare(strict_types=1);

namespace Seven\Api\Response\Numbers;

class PhoneNumber
{
    protected PhoneNumberBilling $billing;
    protected string $country;
    protected string $created;
    protected ?string $expires;
    protected PhoneNumberFeatures $features;
    protected PhoneNumberForwardInboundSms $forwardInboundSms;
    protected string $friendlyName;
    protected string $number;

    public function __construct(object $data)
    {
        $this->billing = new PhoneNumberBilling($data->billing);
        $this->country = $data->country;
        $this->created = $data->created;
        $this->expires = $data->expires;
        $this->features = new PhoneNumberFeatures($data->features);
        $this->forwardInboundSms = new PhoneNumberForwardInboundSms($data->forward_sms_mo);
        $this->friendlyName = $data->friendly_name;
        $this->number = $data->number;
    }

    public function getBilling(): PhoneNumberBilling
    {
        return $this->billing;
    }

    public function setBilling(PhoneNumberBilling $billing): PhoneNumber
    {
        $this->billing = $billing;
        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): PhoneNumber
    {
        $this->country = $country;
        return $this;
    }

    public function getCreated(): string
    {
        return $this->created;
    }

    public function setCreated(string $created): PhoneNumber
    {
        $this->created = $created;
        return $this;
    }

    public function getExpires(): ?string
    {
        return $this->expires;
    }

    public function setExpires(?string $expires): PhoneNumber
    {
        $this->expires = $expires;
        return $this;
    }

    public function getFeatures(): PhoneNumberFeatures
    {
        return $this->features;
    }

    public function setFeatures(PhoneNumberFeatures $features): PhoneNumber
    {
        $this->features = $features;
        return $this;
    }

    public function getForwardInboundSms(): PhoneNumberForwardInboundSms
    {
        return $this->forwardInboundSms;
    }

    public function setForwardInboundSms(PhoneNumberForwardInboundSms $forwardInboundSms): PhoneNumber
    {
        $this->forwardInboundSms = $forwardInboundSms;
        return $this;
    }

    public function getFriendlyName(): string
    {
        return $this->friendlyName;
    }

    public function setFriendlyName(string $friendlyName): PhoneNumber
    {
        $this->friendlyName = $friendlyName;
        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): PhoneNumber
    {
        $this->number = $number;
        return $this;
    }
}
