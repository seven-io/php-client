<?php declare(strict_types=1);

namespace Seven\Api\Constant;

use Seven\Api\Library\Reflectable;

class ContactsAction {
    use Reflectable;

    public const DELETE = 'del';
    public const READ = 'read';
    public const WRITE = 'write';
}
