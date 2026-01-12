<?php declare(strict_types=1);

namespace Seven\Api\Resource\Contacts;

class Validation {
    protected ?string $state = null;
    protected ?string $timestamp = null;

    public static function fromApi(object $obj): Validation {
        $validation = new Validation;
        $validation->state = $obj->state !== null ? (string)$obj->state : null;
        $validation->timestamp = $obj->timestamp !== null ? (string)$obj->timestamp : null;
        return $validation;
    }

    public function getState(): ?string {
        return $this->state;
    }

    public function getTimestamp(): ?string {
        return $this->timestamp;
    }
}
