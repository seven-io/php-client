<?php declare(strict_types=1);

namespace Sms77\Api\Library;

abstract class JsonObject {
    public function __construct(?object $class = null) {
        if ($class) {
            foreach ($class as $key => $value) {
                $this->{$key} = $value;
            }
        }
    }
}