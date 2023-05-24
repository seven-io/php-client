<?php declare(strict_types=1);

namespace Sms77\Api\Constant;

class HooksConstants {
    public const ACTION_READ = 'read';
    public const ACTION_SUBSCRIBE = 'subscribe';
    public const ACTION_UNSUBSCRIBE = 'unsubscribe';

    public const ACTIONS = [
        self::ACTION_READ,
        self::ACTION_SUBSCRIBE,
        self::ACTION_UNSUBSCRIBE,
    ];

    public const EVENT_TYPE_ALL = 'all';
    public const EVENT_TYPE_SMS_INBOUND = 'sms_mo';
    public const EVENT_TYPE_SMS_STATUS = 'dlr';
    public const EVENT_TYPE_TRACKING = 'tracking';
    public const EVENT_TYPE_VOICE_CALL = 'voice_call';
    public const EVENT_TYPE_VOICE_STATUS = 'voice_status';

    public const EVENT_TYPES = [
        self::EVENT_TYPE_ALL,
        self::EVENT_TYPE_SMS_INBOUND,
        self::EVENT_TYPE_SMS_STATUS,
        self::EVENT_TYPE_TRACKING,
        self::EVENT_TYPE_VOICE_CALL,
        self::EVENT_TYPE_VOICE_STATUS,
    ];

    public const REQUEST_METHOD_GET = 'GET';
    public const REQUEST_METHOD_JSON = 'JSON';
    public const REQUEST_METHOD_POST = 'POST';
    public const REQUEST_METHOD_DEFAULT = self::REQUEST_METHOD_POST;

    public const REQUEST_METHODS = [
        self::REQUEST_METHOD_POST,
        self::REQUEST_METHOD_JSON,
        self::REQUEST_METHOD_GET,
    ];
}
