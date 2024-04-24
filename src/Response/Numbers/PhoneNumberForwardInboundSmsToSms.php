<?php declare(strict_types=1);

namespace Seven\Api\Response\Numbers;

class PhoneNumberForwardInboundSmsToSms
{
    protected bool $enabled;
    /** @var string[] $numbers */
    protected array $numbers;

    public function __construct(object $data)
    {
        $this->enabled = $data->enabled;
        $this->numbers = $data->number;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): PhoneNumberForwardInboundSmsToSms
    {
        $this->enabled = $enabled;
        return $this;
    }

    public function getNumbers(): array
    {
        return $this->numbers;
    }

    public function setNumbers(array $numbers): PhoneNumberForwardInboundSmsToSms
    {
        $this->numbers = $numbers;
        return $this;
    }
}
