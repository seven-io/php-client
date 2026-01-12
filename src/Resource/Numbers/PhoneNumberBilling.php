<?php declare(strict_types=1);

namespace Seven\Api\Resource\Numbers;

class PhoneNumberBilling {
    protected PhoneNumberBillingFees $fees;
    protected PaymentInterval $paymentInterval;

    public function __construct(object $data) {
        $this->fees = new PhoneNumberBillingFees($data->fees);
        $this->paymentInterval = PaymentInterval::from((string)$data->payment_interval);
    }

    public function getFees(): PhoneNumberBillingFees {
        return $this->fees;
    }

    public function setFees(PhoneNumberBillingFees $fees): PhoneNumberBilling {
        $this->fees = $fees;
        return $this;
    }

    public function getPaymentInterval(): PaymentInterval {
        return $this->paymentInterval;
    }

    public function setPaymentInterval(PaymentInterval $paymentInterval): PhoneNumberBilling {
        $this->paymentInterval = $paymentInterval;
        return $this;
    }
}
