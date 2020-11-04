<?php declare(strict_types=1);

namespace Sms77\Api\Constant;

use Sms77\Api\Library\Reflectable;

class SmsOptions {
    use Reflectable;

    public const Debug = 'debug';
    public const Delay = 'delay';
    public const Details = 'details';
    public const Flash = 'flash';
    public const ForeignId = 'foreign_id';
    public const From = 'from';
    public const Json = 'json';
    public const Label = 'label';
    public const NoReload = 'no_reload';
    public const PerformanceTracking = 'performance_tracking';
    public const ReturnMsgId = 'return_msg_id';
    public const Text = 'text';
    public const To = 'to';
    public const Ttl = 'ttl';
    public const Udh = 'udh';
    public const Unicode = 'unicode';
    public const Utf8 = 'utf8';
}