<?php declare(strict_types=1);

namespace Seven\Api\Resource\Numbers;

class PhoneNumberBillingFees {
    protected float $basicCharge;
    protected float $setup;
    protected float $smsInbound;
    protected float $voiceInbound;

    public function __construct(object $data) {
        $this->basicCharge = $data->basic_charge;
        $this->setup = $data->setup;
        $this->smsInbound = $data->sms_mo;
        $this->voiceInbound = $data->voice_mo;
    }

    public function getBasicCharge(): float {
        return $this->basicCharge;
    }

    public function setBasicCharge(float $basicCharge): PhoneNumberBillingFees {
        $this->basicCharge = $basicCharge;
        return $this;
    }

    public function getSetup(): float {
        return $this->setup;
    }

    public function setSetup(float $setup): PhoneNumberBillingFees {
        $this->setup = $setup;
        return $this;
    }

    public function getSmsInbound(): float {
        return $this->smsInbound;
    }

    public function setSmsInbound(float $smsInbound): PhoneNumberBillingFees {
        $this->smsInbound = $smsInbound;
        return $this;
    }

    public function getVoiceInbound(): float {
        return $this->voiceInbound;
    }

    public function setVoiceInbound(float $voiceInbound): PhoneNumberBillingFees {
        $this->voiceInbound = $voiceInbound;
        return $this;
    }
}
