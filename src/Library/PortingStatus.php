<?php declare(strict_types=1);

namespace Seven\Api\Library;

enum PortingStatus: string {
    case AssumedNotPorted = 'assumed_not_ported';
    case AssumedPorted = 'assumed_ported';
    case NotPorted = 'not_ported';
    case Ported = 'ported';
    case Unknown = 'unknown';
}
