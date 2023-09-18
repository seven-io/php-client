<?php declare(strict_types=1);

namespace Seven\Api\Constant;

use Seven\Api\Library\Reflectable;

class HooksEventType {
    use Reflectable;

    public const ALL = 'all';
    public const SMS_INBOUND = 'sms_mo';
    public const SMS_STATUS = 'dlr';
    public const TRACKING = 'tracking';
    public const VOICE_CALL = 'voice_call';
    public const VOICE_STATUS = 'voice_status';
}
