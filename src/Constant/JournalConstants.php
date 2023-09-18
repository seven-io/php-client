<?php declare(strict_types=1);

namespace Seven\Api\Constant;

class JournalConstants {
    public const DATE_PATTERN = "/[\d]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][\d]|3[0-1])/";

    public const ENDPOINT = 'journal';

    public const LIMIT_MIN = 1;
    public const LIMIT_MAX = 100;
}
