<?php declare(strict_types=1);

namespace Seven\Api\Response\Contacts;

class Contact {
    protected int $id;
    protected string $name;
    protected string $number;

    public function __construct(object $data) {
        $this->id = (int)$data->ID;
        $this->name = $data->Name;
        $this->number = $data->Number;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getNumber(): string {
        return $this->number;
    }
}
