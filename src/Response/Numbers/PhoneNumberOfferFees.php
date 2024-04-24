<?php declare(strict_types=1);

namespace Seven\Api\Response\Numbers;

readonly class PhoneNumberOfferFees
{
    protected PhoneNumberOfferFeesPeriod $annually;
    protected float $inboundSms;
    protected float $inboundVoice;
    protected PhoneNumberOfferFeesPeriod $monthly;

    public function __construct(object $data)
    {
        $this->annually = new PhoneNumberOfferFeesPeriod($data->annually);
        $this->monthly = new PhoneNumberOfferFeesPeriod($data->monthly);
        $this->inboundSms = $data->sms_mo;
        $this->inboundVoice = $data->voice_mo;
    }

    public function getAnnually(): PhoneNumberOfferFeesPeriod
    {
        return $this->annually;
    }

    public function getInboundSms(): float
    {
        return $this->inboundSms;
    }

    public function getInboundVoice(): float
    {
        return $this->inboundVoice;
    }

    public function getMonthly(): PhoneNumberOfferFeesPeriod
    {
        return $this->monthly;
    }
}
