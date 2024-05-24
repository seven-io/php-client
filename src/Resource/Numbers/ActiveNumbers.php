<?php declare(strict_types=1);

namespace Seven\Api\Resource\Numbers;

readonly class ActiveNumbers {
    /**
     * @var PhoneNumber[] $activeNumbers
     */
    protected array $activeNumbers;

    public function __construct(object $data) {
        $this->activeNumbers = array_map(fn($obj) => new PhoneNumber($obj), $data->activeNumbers);
    }

    public function getActiveNumbers(): array {
        return $this->activeNumbers;
    }
}
