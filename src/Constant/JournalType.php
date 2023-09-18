<?php declare(strict_types=1);

namespace Seven\Api\Constant;

use Seven\Api\Library\Reflectable;

class JournalType {
    use Reflectable;

    public const INBOUND = 'inbound';
    public const OUTBOUND = 'outbound';
    public const REPLIES = 'replies';
    public const VOICE = 'voice';
}
