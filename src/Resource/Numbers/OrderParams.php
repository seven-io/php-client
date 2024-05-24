<?php declare(strict_types=1);

namespace Seven\Api\Resource\Numbers;

use Seven\Api\Library\ParamsInterface;

class OrderParams implements ParamsInterface {
    protected PaymentInterval $paymentInterval = PaymentInterval::ANNUALLY;

    public function __construct(protected string $number) {
    }

    public function toArray(): array {
        $arr = get_object_vars($this);

        $arr['payment_interval'] = $this->paymentInterval->value;

        unset($arr['paymentInterval']);

        return $arr;
    }

    public function getPaymentInterval(): ?PaymentInterval {
        return $this->paymentInterval;
    }

    public function setPaymentInterval(?PaymentInterval $paymentInterval): self {
        $this->paymentInterval = $paymentInterval;
        return $this;
    }

    public function getNumber(): string {
        return $this->number;
    }
}
