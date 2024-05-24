<?php declare(strict_types=1);

namespace Seven\Api\Resource\Hooks;

enum HooksRequestMethod {
    case GET;
    case JSON;
    case POST;
}
