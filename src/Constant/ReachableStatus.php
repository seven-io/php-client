<?php declare(strict_types=1);

namespace Sms77\Api\Constant;

use Sms77\Api\Library\Reflectable;

class ReachableStatus {
    use Reflectable;

    public const Unknown = 'unknown';
    public const Reachable = 'reachable';
    public const Undeliverable = 'undeliverable';
    public const Absent = 'absent';
    public const BadNumber = 'bad_number';
    public const Blacklisted = 'blacklisted';
}