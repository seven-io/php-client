<?php declare(strict_types=1);

namespace Sms77\Api\Constant;

class LookupConstants {
    public const TYPE_CNAM = 'cnam';
    public const TYPE_FORMAT = 'format';
    public const TYPE_HLR = 'hlr';
    public const TYPE_MNP = 'mnp';
    public const TYPES = [
        self::TYPE_CNAM,
        self::TYPE_FORMAT,
        self::TYPE_HLR,
        self::TYPE_MNP,
    ];

    public const MNP_TYPE_D1 = 'd1';
    public const MNP_TYPE_D2 = 'd2';
    public const MNP_TYPE_O2 = 'o2';
    public const MNP_TYPE_EPLUS = 'eplus';
    public const MNP_TYPE_NOT_AVAILABLE = 'N/A';
    public const MNP_TYPE_INT = 'int';

    public const MNP_TYPES = [
        self::MNP_TYPE_D1,
        self::MNP_TYPE_D2,
        self::MNP_TYPE_O2,
        self::MNP_TYPE_EPLUS,
        self::MNP_TYPE_NOT_AVAILABLE,
        self::MNP_TYPE_INT,
    ];
}