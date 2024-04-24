<?php declare(strict_types=1);

namespace Seven\Api\Response\Contacts;

class Validation
{
    protected ?string $state = null;
    protected ?string $timestamp = null;

    public static function fromApi(object $obj): Validation
    {
        $validation = new Validation;
        $validation->state = $obj->state;
        $validation->timestamp = $obj->timestamp;
        return $validation;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function getTimestamp(): ?string
    {
        return $this->timestamp;
    }
}
