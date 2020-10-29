<?php declare(strict_types=1);

namespace Sms77\Api\Constant;

use Sms77\Api\Library\Reflectable;

class PortingStatus {
    use Reflectable;

    const Unknown = 'unknown';
    const Ported = 'ported';
    const NotPorted = 'not_ported';
    const AssumedNotPorted = 'assumed_not_ported';
    const AssumedPorted = 'assumed_ported';
}