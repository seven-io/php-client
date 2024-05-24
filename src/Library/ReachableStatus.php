<?php declare(strict_types=1);

namespace Seven\Api\Library;

enum ReachableStatus: string {
    case Absent = 'absent';
    case BadNumber = 'bad_number';
    case Blacklisted = 'blacklisted';
    case Reachable = 'reachable';
    case Undeliverable = 'undeliverable';
    case Unknown = 'unknown';
}
