<?php declare(strict_types=1);

namespace Seven\Api\Resource\Status;

enum StatusMessage: string {
    case Accepted = 'ACCEPTED';
    case Buffered = 'BUFFERED';
    case Delivered = 'DELIVERED';
    case Expired = 'EXPIRED';
    case Failed = 'FAILED';
    case NotDelivered = 'NOTDELIVERED';
    case Rejected = 'REJECTED';
    case Transmitted = 'TRANSMITTED';
    case Unknown = 'UNKNOWN';
}
