<?php declare(strict_types=1);

namespace Sms77\Api\Constant;

use Sms77\Api\Library\Reflectable;

class MnpType {
    use Reflectable;

    public const D1 = 'd1';
    public const D2 = 'd2';
    public const O2 = 'o2';
    public const Eplus = 'eplus';
    public const NotAvailable = 'N/A';
    public const Int = 'int';
}