<?php declare(strict_types=1);

namespace Seven\Api\Response\Contacts;

use DateTime;

class Properties
{
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

    public static function fromApi(object $obj): Properties
    {
        $properties = new Properties;
        $properties->address = $obj->address;
        if ($obj->birthday) $properties->birthday = new DateTime($obj->birthday);
        $properties->city = $obj->city;
        $properties->email = $obj->email;
        $properties->firstname = $obj->firstname;
        $properties->fullname = $obj->fullname;
        $properties->homeNumber = $obj->home_number;
        $properties->lastname = $obj->lastname;
        $properties->mobileNumber = $obj->mobile_number;
        $properties->notes = $obj->notes;
        $properties->postalCode = $obj->postal_code;
        return $properties;
    }

    public function toPayload(): array
    {
        return [
            'address' => $this->getAddress(),
            'birthday' => $this->getBirthday()->format('Y-m-d'),
            'city' => $this->getCity(),
            'email' => $this->getEmail(),
            'firstname' => $this->getFirstname(),
            'home_number' => $this->getHomeNumber(),
            'lastname' => $this->getLastname(),
            'mobile_number' => $this->getMobileNumber(),
            'notes' => $this->getNotes(),
            'postal_code' => $this->getPostalCode(),
        ];
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): Properties
    {
        $this->address = $address;
        return $this;
    }

    public function getBirthday(): ?DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(?DateTime $birthday): Properties
    {
        $this->birthday = $birthday;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): Properties
    {
        $this->city = $city;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): Properties
    {
        $this->email = $email;
        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): Properties
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getHomeNumber(): ?string
    {
        return $this->homeNumber;
    }

    public function setHomeNumber(?string $homeNumber): Properties
    {
        $this->homeNumber = $homeNumber;
        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): Properties
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getMobileNumber(): ?string
    {
        return $this->mobileNumber;
    }

    public function setMobileNumber(?string $mobileNumber): Properties
    {
        $this->mobileNumber = $mobileNumber;
        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): Properties
    {
        $this->notes = $notes;
        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): Properties
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }
}
