<?php declare(strict_types=1);

namespace Sms77\Api\Library;

use DateTime;

class Util {
    public static function isValidUrl(string $url): bool {
        return false !== filter_var($url, FILTER_VALIDATE_URL);
    }

    public static function toArrayOfObject(array $array, string $class): array {
        foreach ($array as $k => $v) {
            $array[$k] = new $class($v);
        }

        return $array;
    }

    /**
     * @param mixed $timestamp
     * @return bool
     */
    public static function isUnixTimestamp($timestamp): bool {
        /* THX to Gordon @ https://stackoverflow.com/questions/2524680/check-whether-the-string-is-a-unix-timestamp */
        return ((string)$timestamp === $timestamp)
            && ($timestamp <= PHP_INT_MAX)
            && ($timestamp >= ~PHP_INT_MAX);
    }

    public static function isValidDate(string $date, string $format): bool {
        $dt = DateTime::createFromFormat($format, $date);

        return false !== $dt && !array_sum($dt::getLastErrors());
    }
}