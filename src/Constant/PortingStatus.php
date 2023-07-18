<?php declare(strict_types=1);

namespace Seven\Api\Constant;

use Seven\Api\Library\Reflectable;

class PortingStatus {
    use Reflectable;

    public const Unknown = 'unknown';
    public const Ported = 'ported';
    public const NotPorted = 'not_ported';
    public const AssumedNotPorted = 'assumed_not_ported';
    public const AssumedPorted = 'assumed_ported';
}
