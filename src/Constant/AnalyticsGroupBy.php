<?php declare(strict_types=1);

namespace Seven\Api\Constant;

use Seven\Api\Library\Reflectable;

class AnalyticsGroupBy {
    use Reflectable;

    public const COUNTRY = 'country';
    public const DATE = 'date';
    public const LABEL = 'label';
    public const SUBACCOUNT = 'subaccount';
}
