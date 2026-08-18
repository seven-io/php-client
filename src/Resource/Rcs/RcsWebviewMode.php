<?php declare(strict_types=1);

namespace Seven\Api\Resource\Rcs;

enum RcsWebviewMode: string
{
    case TALL = 'tall';
    case HALF = 'half';
    case FULL = 'full';
}
