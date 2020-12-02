<?php declare(strict_types=1);

namespace Sms77\Api\Constant;

class JournalConstants {
    public const DATE_PATTERN = "/[\d]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][\d]|3[0-1])/";

    public const ENDPOINT = 'journal';

    public const TYPE_INBOUND = 'inbound';
    public const TYPE_OUTBOUND = 'outbound';
    public const TYPE_REPLIES = 'replies';
    public const TYPE_VOICE = 'voice';

    public const TYPES = [
        self::TYPE_INBOUND,
        self::TYPE_OUTBOUND,
        self::TYPE_REPLIES,
        self::TYPE_VOICE,
    ];
}