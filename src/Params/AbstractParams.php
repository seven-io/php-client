<?php declare(strict_types=1);

namespace Sms77\Api\Params;

abstract class AbstractParams {
    public function toArray(): array {
        return get_object_vars($this);
    }
}