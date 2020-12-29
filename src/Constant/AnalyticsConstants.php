<?php declare(strict_types=1);

namespace Sms77\Api\Constant;

class AnalyticsConstants {
    public const GROUP_BY_DATE = 'date';
    public const GROUP_BY_COUNTRY = 'country';
    public const GROUP_BY_LABEL = 'label';
    public const GROUP_BY_SUBACCOUNT = 'subaccount';

    public const GROUP_BY = [
        self::GROUP_BY_DATE,
        self::GROUP_BY_COUNTRY,
        self::GROUP_BY_LABEL,
        self::GROUP_BY_SUBACCOUNT,
    ];

    public const SUBACCOUNTS_MAIN = 'only_main';
    public const SUBACCOUNTS_ALL = 'all';

    public const SUBACCOUNTS = [
        self::SUBACCOUNTS_MAIN,
        self::SUBACCOUNTS_ALL,
    ];
}