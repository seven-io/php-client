<?php declare(strict_types=1);

namespace Seven\Api\Resource\Contacts;

class Contact {
    protected string $avatar;
    protected readonly string $created;
    protected readonly int $id;
    protected Initials $initials;
    /** @var int[] $groups */
    protected array $groups = [];
    protected Properties $properties;
    protected Validation $validation;

    public static function fromApi(object $obj): Contact {
        $contact = new Contact;
        $contact->avatar = $obj->avatar;
        $contact->created = $obj->created;
        $contact->groups = $obj->groups;
        $contact->id = $obj->id;
        $contact->initials = Initials::fromApi($obj->initials);
        $contact->properties = Properties::fromApi($obj->properties);
        $contact->validation = Validation::fromApi($obj->validation);
        return $contact;
    }

    public function toPayload(): array {
        return [
            ...$this->properties->toPayload(),
            'avatar' => $this->avatar,
            'groups[]' => $this->groups,
        ];
    }

    public function getAvatar(): string {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): Contact {
        $this->avatar = $avatar;
        return $this;
    }

    public function getInitials(): Initials {
        return $this->initials;
    }

    public function setInitials(Initials $initials): Contact {
        $this->initials = $initials;
        return $this;
    }

    public function getGroups(): array {
        return $this->groups;
    }

    public function setGroups(array $groups): Contact {
        $this->groups = $groups;
        return $this;
    }

    public function getProperties(): Properties {
        return $this->properties;
    }

    public function setProperties(Properties $properties): Contact {
        $this->properties = $properties;
        return $this;
    }

    public function getValidation(): Validation {
        return $this->validation;
    }

    public function setValidation(Validation $validation): Contact {
        $this->validation = $validation;
        return $this;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getCreated(): string {
        return $this->created;
    }
}
