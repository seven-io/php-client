<?php declare(strict_types=1);

namespace Seven\Api\Constant;

enum AnalyticsSubaccounts: string
{
    case ALL = 'all';
    case MAIN = 'only_main';
}
