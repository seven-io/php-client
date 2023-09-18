<?php declare(strict_types=1);

namespace Seven\Api\Constant;

use Seven\Api\Library\Reflectable;

class StatusMessage {
    use Reflectable;

    public const Accepted = 'ACCEPTED';
    public const Buffered = 'BUFFERED';
    public const Delivered = 'DELIVERED';
    public const Expired = 'EXPIRED';
    public const Failed = 'FAILED';
    public const NotDelivered = 'NOTDELIVERED';
    public const Rejected = 'REJECTED';
    public const Transmitted = 'TRANSMITTED';
    public const Unknown = 'UNKNOWN';
}
