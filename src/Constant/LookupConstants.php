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
}