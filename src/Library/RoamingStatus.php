<?php declare(strict_types=1);

namespace Seven\Api\Library;

enum RoamingStatus: string {
    case NotRoaming = 'not_roaming';
    case Roaming = 'roaming';
    case Unknown = 'unknown';
}
