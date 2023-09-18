<?php declare(strict_types=1);

namespace Seven\Api\Constant;

use Seven\Api\Library\Reflectable;

class RoamingStatus {
    use Reflectable;

    public const NotRoaming = 'not_roaming';
    public const Roaming = 'roaming';
    public const Unknown = 'unknown';
}
