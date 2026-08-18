<?php declare(strict_types=1);

namespace Seven\Api\Resource\Rcs;

use Seven\Api\Library\ParamsInterface;

readonly class RcsLocationParams implements ParamsInterface
{
    public function __construct(
        public float $latitude,
        public float $longitude,
        public ?string $label = null,
    ) {
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
