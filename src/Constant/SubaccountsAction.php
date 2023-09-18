<?php

namespace Seven\Api\Constant;

use Seven\Api\Library\Reflectable;

final class SubaccountsAction {
    use Reflectable;

    public const CREATE = 'create';
    public const DELETE = 'delete';
    public const READ = 'read';
    public const TRANSFER_CREDITS = 'transfer_credits';
    public const UPDATE = 'update';
}
