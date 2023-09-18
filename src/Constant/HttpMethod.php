<?php declare(strict_types=1);

namespace Seven\Api\Constant;

use Seven\Api\Library\Reflectable;

class HttpMethod {
    use Reflectable;

    public const DELETE = 'DELETE';
    public const GET = 'GET';
    public const POST = 'POST';
}
