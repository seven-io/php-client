<?php declare(strict_types=1);

namespace Sms77\Api\Library;

use ReflectionClass;

trait Reflectable {
    /** @return array */
    public static function values() {
        $reflector = new ReflectionClass(self::class);
        $constants = $reflector->getConstants();
        return array_values($constants);
    }
}