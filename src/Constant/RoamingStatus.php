<?php

namespace Sms77\Api\Constant;

use Sms77\Api\Reflectable;

class RoamingStatus {
    use Reflectable;

    const Unknown = 'unknown';
    const Roaming = 'roaming';
    const NotRoaming = 'not_roaming';
}