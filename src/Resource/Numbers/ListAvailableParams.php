<?php declare(strict_types=1);

namespace Seven\Api\Resource\Numbers;

use Seven\Api\Library\ParamsInterface;

class ListAvailableParams implements ParamsInterface
{
    protected ?string $country = null;
    protected bool $featuresSms = false;
    protected bool $featuresApplicationToPersonSms = false;
    protected bool $featuresVoice = false;

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): ListAvailableParams
    {
        $this->country = $country;
        return $this;
    }

    public function isFeaturesSms(): bool
    {
        return $this->featuresSms;
    }

    public function setFeaturesSms(bool $featuresSms): ListAvailableParams
    {
        $this->featuresSms = $featuresSms;
        return $this;
    }

    public function isFeaturesApplicationToPersonSms(): bool
    {
        return $this->featuresApplicationToPersonSms;
    }

    public function setFeaturesApplicationToPersonSms(bool $featuresApplicationToPersonSms): ListAvailableParams
    {
        $this->featuresApplicationToPersonSms = $featuresApplicationToPersonSms;
        return $this;
    }

    public function isFeaturesVoice(): bool
    {
        return $this->featuresVoice;
    }

    public function setFeaturesVoice(bool $featuresVoice): ListAvailableParams
    {
        $this->featuresVoice = $featuresVoice;
        return $this;
    }

    public function toArray(): array
    {
        $arr = get_object_vars($this);

        $arr['features_a2p_sms'] = $this->featuresApplicationToPersonSms;
        $arr['features_sms'] = $this->featuresSms;
        $arr['features_voice'] = $this->featuresVoice;

        unset($arr['featuresApplicationToPersonSms'], $arr['featuresSms'], $arr['featuresVoice']);

        return $arr;
    }
}
