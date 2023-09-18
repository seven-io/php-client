<?php declare(strict_types=1);

namespace Seven\Api\Constant;

use Seven\Api\Library\Reflectable;

class HooksRequestMethod {
    use Reflectable;

    public const GET = 'GET';
    public const JSON = 'JSON';
    public const POST = 'POST';
    public const DEFAULT = self::POST;
}
