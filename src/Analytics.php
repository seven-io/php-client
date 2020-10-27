<?php

namespace Sms77\Api;

use stdClass;

/**
 * @property-read string date
 * @property-read string country
 * @property-read string account
 * @property-read string label
 * @property-read int economy
 * @property-read int direct
 * @property-read int voice
 * @property-read int hlr
 * @property-read int mnp
 * @property-read int inbound
 * @property-read float usage_eur
 */
class Analytics {
    /** @param stdClass $class */
    public function __construct($class) {
        foreach ($class as $key => $value) {
            $this->{$key} = $value;
        }
    }
}