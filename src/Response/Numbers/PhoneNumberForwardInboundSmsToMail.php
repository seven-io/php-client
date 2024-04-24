<?php declare(strict_types=1);

namespace Seven\Api\Response\Numbers;

class PhoneNumberForwardInboundSmsToMail
{
    /** @var string[] $numbers */
    protected array $addresses;
    protected bool $enabled;

    public function __construct(object $data)
    {
        $this->addresses = $data->address;
        $this->enabled = $data->enabled;
    }

    public function getAddresses(): array
    {
        return $this->addresses;
    }

    public function setAddresses(array $addresses): PhoneNumberForwardInboundSmsToMail
    {
        $this->addresses = $addresses;
        return $this;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): PhoneNumberForwardInboundSmsToMail
    {
        $this->enabled = $enabled;
        return $this;
    }
}
