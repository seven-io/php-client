<?php declare(strict_types=1);

namespace Sms77\Api\Constant;

class ContactsConstants {
    public const ACTION_READ = 'read';
    public const ACTION_WRITE = 'write';
    public const ACTION_DEL = 'del';
    public const ACTIONS = [self::ACTION_READ, self::ACTION_DEL, self::ACTION_WRITE];
}