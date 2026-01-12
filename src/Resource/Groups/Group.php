<?php declare(strict_types=1);

namespace Seven\Api\Resource\Groups;

class Group {
    protected string $created;
    protected int $id;
    protected string $name;
    protected int $membersCount;

    public function __construct(object $data) {
        $this->created = (string)$data->created;
        $this->id = (int)$data->id;
        $this->membersCount = (int)$data->members_count;
        $this->name = (string)$data->name;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getCreated(): string {
        return $this->created;
    }

    public function getMembersCount(): int {
        return $this->membersCount;
    }
}
