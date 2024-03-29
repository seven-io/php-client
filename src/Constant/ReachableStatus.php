<?php declare(strict_types=1);

namespace Seven\Api\Constant;

use Seven\Api\Library\Reflectable;

class ReachableStatus {
    use Reflectable;

    public const Absent = 'absent';
    public const BadNumber = 'bad_number';
    public const Blacklisted = 'blacklisted';
    public const Reachable = 'reachable';
    public const Undeliverable = 'undeliverable';
    public const Unknown = 'unknown';
}
