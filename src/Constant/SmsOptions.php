<?php declare(strict_types=1);

namespace Sms77\Api\Constant;

use Sms77\Api\Library\Reflectable;

class SmsOptions {
    use Reflectable;

    const Debug = 'debug';
    const Delay = 'delay';
    const Details = 'details';
    const Flash = 'flash';
    const ForeignId = 'foreign_id';
    const From = 'from';
    const Json = 'json';
    const Label = 'label';
    const NoReload = 'no_reload';
    const PerformanceTracking = 'performance_tracking';
    const ReturnMsgId = 'return_msg_id';
    const Text = 'text';
    const To = 'to';
    const Ttl = 'ttl';
    const Udh = 'udh';
    const Unicode = 'unicode';
    const Utf8 = 'utf8';
}