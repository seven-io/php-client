<?php declare(strict_types=1);

namespace Seven\Api\Library;

class Util {
    public static function isValidUrl(string $url): bool {
        return false !== filter_var($url, FILTER_VALIDATE_URL);
    }
}
