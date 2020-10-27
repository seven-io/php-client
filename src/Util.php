<?php

namespace Sms77\Api;

use DateTime;

class Util {
    /**
     * @param string $timestamp
     * @return bool
     */
    public static function isValidUnixTimestamp($timestamp) {
        /*https://stackoverflow.com/questions/2524680/check-whether-the-string-is-a-unix-timestamp*/
        return ((string)$timestamp === $timestamp)
            && ($timestamp <= PHP_INT_MAX)
            && ($timestamp >= ~PHP_INT_MAX);
    }

    /**
     * @param string $date
     * @param string $format
     * @return bool
     */
    public static function isValidDate($date, $format) {
        $dt = DateTime::createFromFormat($format, $date);

        return false !== $dt && !array_sum($dt::getLastErrors());
    }
}