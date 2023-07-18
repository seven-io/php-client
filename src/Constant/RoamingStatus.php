<?php declare(strict_types=1);

namespace Seven\Api\Constant;

use Seven\Api\Library\Reflectable;

class RoamingStatus {
    use Reflectable;

    public const Unknown = 'unknown';
    public const Roaming = 'roaming';
    public const NotRoaming = 'not_roaming';
}
