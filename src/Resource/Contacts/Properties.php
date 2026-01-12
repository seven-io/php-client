<?php declare(strict_types=1);

namespace Seven\Api\Resource\Contacts;

use DateTime;

class Properties {
    protected ?string $address = null;
    protected ?DateTime $birthday = null;
    protected ?string $city = null;
    protected ?string $email = null;
    protected ?string $firstname = null;
    protected ?string $fullname = null;
    protected ?string $homeNumber = null;
    protected ?string $lastname = null;
    protected ?string $mobileNumber = null;
    protected ?string $notes = null;
    protected ?string $postalCode = null;

    public static function fromApi(object $obj): Properties {
        $properties = new Properties;
        $properties->address = $obj->address !== null ? (string)$obj->address : null;
        if ($obj->birthday) $properties->birthday = new DateTime((string)$obj->birthday);
        $properties->city = $obj->city !== null ? (string)$obj->city : null;
        $properties->email = $obj->email !== null ? (string)$obj->email : null;
        $properties->firstname = $obj->firstname !== null ? (string)$obj->firstname : null;
        $properties->fullname = $obj->fullname !== null ? (string)$obj->fullname : null;
        $properties->homeNumber = $obj->home_number !== null ? (string)$obj->home_number : null;
        $properties->lastname = $obj->lastname !== null ? (string)$obj->lastname : null;
        $properties->mobileNumber = $obj->mobile_number !== null ? (string)$obj->mobile_number : null;
        $properties->notes = $obj->notes !== null ? (string)$obj->notes : null;
        $properties->postalCode = $obj->postal_code !== null ? (string)$obj->postal_code : null;
        return $properties;
    }

    public function toPayload(): array {
        $payload = [];
        if ($this->getAddress() !== null) $payload['address'] = $this->getAddress();
        if ($this->getBirthday() !== null) $payload['birthday'] = $this->getBirthday()->format('Y-m-d');
        if ($this->getCity() !== null) $payload['city'] = $this->getCity();
        if ($this->getEmail() !== null) $payload['email'] = $this->getEmail();
        if ($this->getFirstname() !== null) $payload['firstname'] = $this->getFirstname();
        if ($this->getHomeNumber() !== null) $payload['home_number'] = $this->getHomeNumber();
        if ($this->getLastname() !== null) $payload['lastname'] = $this->getLastname();
        if ($this->getMobileNumber() !== null) $payload['mobile_number'] = $this->getMobileNumber();
        if ($this->getNotes() !== null) $payload['notes'] = $this->getNotes();
        if ($this->getPostalCode() !== null) $payload['postal_code'] = $this->getPostalCode();
        return $payload;
    }

    public function getAddress(): ?string {
        return $this->address;
    }

    public function setAddress(?string $address): Properties {
        $this->address = $address;
        return $this;
    }

    public function getBirthday(): ?DateTime {
        return $this->birthday;
    }

    public function setBirthday(?DateTime $birthday): Properties {
        $this->birthday = $birthday;
        return $this;
    }

    public function getCity(): ?string {
        return $this->city;
    }

    public function setCity(?string $city): Properties {
        $this->city = $city;
        return $this;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $email): Properties {
        $this->email = $email;
        return $this;
    }

    public function getFirstname(): ?string {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): Properties {
        $this->firstname = $firstname;
        return $this;
    }

    public function getHomeNumber(): ?string {
        return $this->homeNumber;
    }

    public function setHomeNumber(?string $homeNumber): Properties {
        $this->homeNumber = $homeNumber;
        return $this;
    }

    public function getLastname(): ?string {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): Properties {
        $this->lastname = $lastname;
        return $this;
    }

    public function getMobileNumber(): ?string {
        return $this->mobileNumber;
    }

    public function setMobileNumber(?string $mobileNumber): Properties {
        $this->mobileNumber = $mobileNumber;
        return $this;
    }

    public function getNotes(): ?string {
        return $this->notes;
    }

    public function setNotes(?string $notes): Properties {
        $this->notes = $notes;
        return $this;
    }

    public function getPostalCode(): ?string {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): Properties {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function getFullname(): ?string {
        return $this->fullname;
    }
}
