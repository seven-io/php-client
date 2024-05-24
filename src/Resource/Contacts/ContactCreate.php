<?php declare(strict_types=1);

namespace Seven\Api\Resource\Contacts;

class ContactCreate {
    protected int $code;
    protected int $id;

    public function __construct(object $response) {
        $this->code = (int)$response->return;
        $this->id = (int)$response->id;
    }

    public function getCode(): int {
        return $this->code;
    }

    public function getId(): int {
        return $this->id;
    }
}
