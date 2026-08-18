<?php declare(strict_types=1);

namespace Seven\Api\Resource\Rcs;

enum RcsFileHeight: string
{
    case SHORT = 'short';
    case MEDIUM = 'medium';
    case TALL = 'tall';
}
