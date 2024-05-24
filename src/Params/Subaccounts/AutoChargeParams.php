<?php declare(strict_types=1);

namespace Seven\Api\Params\Subaccounts;

use Seven\Api\Exception\InvalidRequiredArgumentException;

readonly class AutoChargeParams
{
    /**
     * @throws InvalidRequiredArgumentException
     */
    public function __construct(public int $id, public float $amount, public float $threshold)
    {
        if ($id <= 0) throw new InvalidRequiredArgumentException('Parameter \'id\' is invalid.');
        if ($amount < 0) throw new InvalidRequiredArgumentException('Parameter \'amount\' is must be >= 0.');
        if ($threshold <= 0) throw new InvalidRequiredArgumentException('Parameter \'threshold\' must be positive.');
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
