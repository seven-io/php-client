<?php declare(strict_types=1);

namespace Seven\Api\Params\Subaccounts;

use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Params\ParamsInterface;

readonly class TransferCreditsParams implements ParamsInterface
{
    /**
     * @throws InvalidRequiredArgumentException
     */
    public function __construct(public int $id, public float $amount)
    {
        if ($id <= 0) throw new InvalidRequiredArgumentException('Parameter \'id\' is invalid.');
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
