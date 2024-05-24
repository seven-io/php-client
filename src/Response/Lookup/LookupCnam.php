<?php declare(strict_types=1);

namespace Seven\Api\Response\Lookup;

class LookupCnam
{
    protected string|int $code;
    protected ?string $name = null;
    protected ?string $number = null;
    protected ?bool $success = null;

    public function __construct(object $data)
    {
        $this->code = $data->code;

        if (is_string($data->code)) {
            $this->name = $data->name;
            $this->number = $data->number;
            $this->success = 'true' === $data->success;
        }
    }

    public function getCode(): string|int
    {
        return $this->code;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function isSuccess(): ?bool
    {
        return $this->success;
    }
}
