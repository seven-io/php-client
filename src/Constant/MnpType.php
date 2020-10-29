<?php declare(strict_types=1);

namespace Sms77\Api\Constant;

use Sms77\Api\Library\Reflectable;

class MnpType {
    use Reflectable;

    const D1 = 'd1';
    const D2 = 'd2';
    const O2 = 'o2';
    const Eplus = 'eplus';
    const NotAvailable = 'N/A';
    const Int = 'int';
}