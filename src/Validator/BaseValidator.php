<?php

namespace Sms77\Api\Validator;

use Sms77\Api\Constant\SmsType;
use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

class BaseValidator {
    /* @var array $parameters */
    protected $parameters;

    /**
     * @param array $parameters
     * @throws InvalidRequiredArgumentException
     */
    public function __construct(array $parameters) {
        $this->parameters = $parameters;

        if (!isset($parameters['p'])) {
            throw new InvalidRequiredArgumentException('p is missing.');
        }
    }

    /**
     * @param $data
     * @return bool
     */
    protected function isValidBool($data) {
        $data = (int)$data;

        return 1 === $data || 0 === $data;
    }

    /**
     * @throws InvalidOptionalArgumentException
     */
    protected function throwOnOptionalBadType() {
        $smsTypes = SmsType::values();

        $type = $this->fallback('type');

        if (null !== $type && !in_array($type, $smsTypes, true)) {
            throw new InvalidOptionalArgumentException("type has invalid value $type. Allowed values are: " . implode(',', $smsTypes) . '.');
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

    /**
     * @param $timestamp
     * @return bool
     */
    protected function isValidUnixTimestamp($timestamp) {
        /*https://stackoverflow.com/questions/2524680/check-whether-the-string-is-a-unix-timestamp*/
        return ((string)$timestamp === $timestamp)
            && ($timestamp <= PHP_INT_MAX)
            && ($timestamp >= ~PHP_INT_MAX);
    }
}