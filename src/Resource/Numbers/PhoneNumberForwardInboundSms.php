<?php declare(strict_types=1);

namespace Seven\Api\Resource\Numbers;

class PhoneNumberForwardInboundSms {
    protected PhoneNumberForwardInboundSmsToMail $email;
    protected PhoneNumberForwardInboundSmsToSms $sms;

    public function __construct(object $data) {
        $this->email = new PhoneNumberForwardInboundSmsToMail($data->email);
        $this->sms = new PhoneNumberForwardInboundSmsToSms($data->sms);
    }

    public function getEmail(): PhoneNumberForwardInboundSmsToMail {
        return $this->email;
    }

    public function setEmail(PhoneNumberForwardInboundSmsToMail $email): PhoneNumberForwardInboundSms {
        $this->email = $email;
        return $this;
    }

    public function getSms(): PhoneNumberForwardInboundSmsToSms {
        return $this->sms;
    }

    public function setSms(PhoneNumberForwardInboundSmsToSms $sms): PhoneNumberForwardInboundSms {
        $this->sms = $sms;
        return $this;
    }
}
