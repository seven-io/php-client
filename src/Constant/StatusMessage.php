<?php declare(strict_types=1);

namespace Seven\Api\Constant;

use Seven\Api\Library\Reflectable;

class StatusMessage {
    use Reflectable;

    public const Delivered = 'DELIVERED';
    public const NotDelivered = 'NOTDELIVERED';
    public const Buffered = 'BUFFERED';
    public const Transmitted = 'TRANSMITTED';
    public const Accepted = 'ACCEPTED';
    public const Expired = 'EXPIRED';
    public const Rejected = 'REJECTED';
    public const Failed = 'FAILED';
    public const Unknown = 'UNKNOWN';
}
