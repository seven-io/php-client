<?php

namespace Sms77\Api;

class Constants {
    const types = ['direct', 'economy'];

    const statusMessages = [
        'DELIVERED',
        'NOTDELIVERED',
        'BUFFERED',
        'TRANSMITTED',
        'ACCEPTED',
        'EXPIRED',
        'REJECTED',
        'FAILED',
        'UNKNOWN',
    ];

    const statusCodes = [
        11,
        100,
        101,
        201,
        202,
        301,
        304,
        305,
        400,
        401,
        402,
        403,
        500,
        600,
        700,
        900,
        902,
        903,
    ];

    const networkTypes = [
        'fixed_line',
        'fixed_line_or_mobile',
        'mobile',
        'pager',
        'personal_number',
        'premium_rate',
        'shared_cost',
        'toll_free',
        'uan',
        'unknown',
        'voicemail',
        'voip',
    ];

    const mnpTypes = [
        'd1',
        'd2',
        'o2',
        'eplus',
        'N/A',
        'int',
    ];

    const portingStatuses = [
        'unknown',
        'ported',
        'not_ported',
        'assumed_not_ported',
        'assumed_ported',
    ];

    const reachableStatuses = [
        'unknown',
        'reachable',
        'undeliverable',
        'absent',
        'bad_number',
        'blacklisted',
    ];

    const roamingStatuses = [
        'unknown',
        'roaming',
        'not_roaming',
    ];
}