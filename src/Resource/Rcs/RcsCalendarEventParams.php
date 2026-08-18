<?php declare(strict_types=1);

namespace Seven\Api\Resource\Rcs;

use Seven\Api\Library\ParamsInterface;

readonly class RcsCalendarEventParams implements ParamsInterface
{
    public function __construct(
        public string $startTime,
        public string $endTime,
        public string $title,
        public string $description,
    ) {
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
