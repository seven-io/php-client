<?php declare(strict_types=1);

namespace Sms77\Api\Constant;

use Sms77\Api\Library\Reflectable;

class RoamingStatus {
    use Reflectable;

    public const Unknown = 'unknown';
    public const Roaming = 'roaming';
    public const NotRoaming = 'not_roaming';
}