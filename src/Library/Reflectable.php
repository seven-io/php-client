<?php declare(strict_types=1);

namespace Seven\Api\Library;

use ReflectionClass;

trait Reflectable {
    public static function values(): array {
        $reflector = new ReflectionClass(self::class);
        $constants = $reflector->getConstants();
        return array_values($constants);
    }
}
