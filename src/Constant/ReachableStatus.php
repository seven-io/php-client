<?php

namespace Sms77\Api\Constant;

use Sms77\Api\Reflectable;

class ReachableStatus {
    use Reflectable;

    const Unknown = 'unknown';
    const Reachable = 'reachable';
    const Undeliverable = 'undeliverable';
    const Absent = 'absent';
    const BadNumber = 'bad_number';
    const Blacklisted = 'blacklisted';
}