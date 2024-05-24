<?php declare(strict_types=1);

namespace Seven\Api\Resource\Subaccounts;

use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Library\ParamsInterface;

readonly class CreateParams implements ParamsInterface
{
    /**
     * @throws InvalidRequiredArgumentException
     */
    public function __construct(public string $name, public string $email)
    {
        if (!$this->name) throw new InvalidRequiredArgumentException('Parameter \'name\' is empty.');

        if (!$this->email) throw new InvalidRequiredArgumentException('Parameter \'email\' is empty.');
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
