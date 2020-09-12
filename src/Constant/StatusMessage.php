<?php

namespace Sms77\Api\Constant;

use Sms77\Api\Reflectable;

class StatusMessage {
    use Reflectable;

    const Delivered = 'DELIVERED';
    const NotDelivered = 'NOTDELIVERED';
    const Buffered = 'BUFFERED';
    const Transmitted = 'TRANSMITTED';
    const Accepted = 'ACCEPTED';
    const Expired = 'EXPIRED';
    const Rejected = 'REJECTED';
    const Failed = 'FAILED';
    const Unknown = 'UNKNOWN';
}