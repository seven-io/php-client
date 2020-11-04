<?php declare(strict_types=1);

namespace Sms77\Api\Constant;

use Sms77\Api\Library\Reflectable;

class PortingStatus {
    use Reflectable;

    public const Unknown = 'unknown';
    public const Ported = 'ported';
    public const NotPorted = 'not_ported';
    public const AssumedNotPorted = 'assumed_not_ported';
    public const AssumedPorted = 'assumed_ported';
}