<?php declare(strict_types=1);

namespace Seven\Api\Resource\Groups;

class Group {
    protected string $created;
    protected int $id;
    protected string $name;
    protected int $membersCount;

    public function __construct(object $data) {
        $this->created = $data->created;
        $this->id = $data->id;
        $this->membersCount = $data->members_count;
        $this->name = $data->name;
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
