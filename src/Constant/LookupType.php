<?php declare(strict_types=1);

namespace Seven\Api\Constant;

use Seven\Api\Library\Reflectable;

class LookupType {
    use Reflectable;

    public const CallerName = 'cnam';
    public const Format = 'format';
    public const HomeLocationRegister = 'hlr';
    public const MobileNumberPortability = 'mnp';
}
