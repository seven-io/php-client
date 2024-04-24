<?php

namespace Seven\Api\Constant;

enum SubaccountsAction: string
{
    public const CREATE = 'create';
    public const DELETE = 'delete';
    public const READ = 'read';
    public const TRANSFER_CREDITS = 'transfer_credits';
    public const UPDATE = 'update';
}
