<?php declare(strict_types=1);

namespace Seven\Api\Resource\Hooks;

enum HooksEventType: string {
    case ALL = 'all';
    case RCS = 'rcs';
    case SMS_INBOUND = 'sms_mo';
    case SMS_STATUS = 'dlr';
    case TRACKING = 'tracking';
    case VOICE_CALL = 'voice_call';
    case VOICE_STATUS = 'voice_status';
}
