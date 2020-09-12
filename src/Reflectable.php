<?php

namespace Sms77\Api;

use ReflectionClass;

trait Reflectable {
    public static function values() {
        $reflector = new ReflectionClass(self::class);
        $constants = $reflector->getConstants();
        return array_values($constants);
    }
}