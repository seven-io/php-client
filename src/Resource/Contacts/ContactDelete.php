<?php declare(strict_types=1);

namespace Seven\Api\Resource\Contacts;

class ContactDelete {
    protected int $code;

    public function __construct(int $code) {
        $this->code = $code;
    }

    public function getCode(): int {
        return $this->code;
    }
}
