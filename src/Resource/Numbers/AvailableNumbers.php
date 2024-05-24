<?php declare(strict_types=1);

namespace Seven\Api\Resource\Numbers;

readonly class AvailableNumbers {
    /**
     * @var PhoneNumberOffer[] $availableNumbers
     */
    protected array $availableNumbers;

    public function __construct(object $data) {
        $this->availableNumbers = array_map(fn($obj) => new PhoneNumberOffer($obj), $data->availableNumbers);
    }

    public function getAvailableNumbers(): array {
        return $this->availableNumbers;
    }
}
