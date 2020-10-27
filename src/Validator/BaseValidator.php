<?php

namespace Sms77\Api\Validator;

use Sms77\Api\Constant\SmsType;
use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;
use Sms77\Api\Util;

class BaseValidator {
    /* @var array $parameters */
    protected $parameters;

    /**
     * @param array $parameters
     * @throws InvalidRequiredArgumentException
     */
    public function __construct(array $parameters = []) {
        $this->parameters = $parameters;
    }

    /**
     * @param string $timestamp
     * @return bool
     */
    public function isValidUnixTimestamp($timestamp) {
        return Util::isValidUnixTimestamp($timestamp);
    }

    /**
     * @param string $date
     * @return bool
     */
    public function isValidDate($date) {
        return Util::isValidDate($date, 'Y-m-d');
    }

    /**
     * @param mixed $string
     * @return bool
     */
    protected function isValidBool($string) {
        $string = (int)$string;

        return 1 === $string || 0 === $string;
    }

    /**
     * @throws InvalidOptionalArgumentException
     */
    protected function throwOnOptionalBadType() {
        $smsTypes = SmsType::values();

        $type = $this->fallback('type');

        if (null !== $type && !in_array($type, $smsTypes, true)) {
            throw new InvalidOptionalArgumentException(
                "type has invalid value $type. Allowed values are: "
                . implode(',', $smsTypes) . '.');
        }
    }

    /**
     * @param $key
     * @param mixed|null $fallback
     * @return mixed|null
     */
    protected function fallback($key, $fallback = null) {
        return isset($this->parameters[$key])
            ? $this->parameters[$key] : $fallback;
    }
}