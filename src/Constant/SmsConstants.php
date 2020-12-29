<?php declare(strict_types=1);

namespace Sms77\Api\Constant;

class SmsConstants {
    public const DELAY_DATE_FORMAT = 'yyyy-mm-dd hh:ii';
    public const DELAY_PATTERN =
        '/[\d]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][\d]|3[0-1]) (2[0-3]|[01][\d]):[0-5][\d]/';

    public const LABEL_MAX_LENGTH = 100;
    public const LABEL_PATTERN = "/[0-9a-z\-@_.]/i";

    public const FOREIGN_ID_MAX_LENGTH = 64;
    public const FOREIGN_ID_PATTERN = self::LABEL_PATTERN;

    public const FROM_ALPHANUMERIC_MAX = 11;
    public const FROM_NUMERIC_MAX = 16;
    public const FROM_ALLOWED_CHARS =
        ['/', ' ', '.', '-', '@', '_', '!', '(', ')', '+', '$', ',', '&',];

    public const TEXT_MAX_LENGTH = 1520;
    public const TTL_MIN = 1;
    public const TTL_MAX = PHP_INT_MAX;

    public const TYPE_DIRECT = 'direct';
    public const TYPE_ECONOMY = 'economy';
}