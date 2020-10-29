<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Constant\SmsType;
use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Library\Util;

class BaseValidator {
    /* @var array $parameters */
    protected $parameters;

    /** @param array $parameters */
    public function __construct(array $parameters = []) {
        $this->parameters = $parameters;
    }

    public function isValidUnixTimestamp(string $timestamp): bool {
        return Util::isUnixTimestamp($timestamp);
    }

    public function isValidDate(string $date): bool {
        return Util::isValidDate($date, 'Y-m-d');
    }

    protected function isValidBool($string): bool {
        $string = (int)$string;

        return 1 === $string || 0 === $string;
    }

    /** @throws InvalidOptionalArgumentException */
    protected function throwOnOptionalBadType(): void {
        $smsTypes = SmsType::values();

        $type = $this->fallback('type');

        if (null !== $type && !in_array($type, $smsTypes, true)) {
            throw new InvalidOptionalArgumentException(
                "type has invalid value $type. Allowed values are: "
                . implode(',', $smsTypes) . '.');
        }
    }

    protected function fallback($key, $fallback = null) {
        return $this->parameters[$key] ?? $fallback;
    }
}