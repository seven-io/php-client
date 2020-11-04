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

    public function isValidDate(string $date): bool {
        return Util::isValidDate($date, 'Y-m-d');
    }

    public function isValidBool($string): bool {
        $string = (int)$string;

        return 1 === $string || 0 === $string;
    }

    /** @throws InvalidOptionalArgumentException */
    public function throwOnOptionalBadType(): void {
        $smsTypes = SmsType::values();

        $type = $this->fallback('type');

        if (null !== $type && !in_array($type, $smsTypes, true)) {
            throw new InvalidOptionalArgumentException(
                "type has invalid value $type. Allowed values are: "
                . implode(',', $smsTypes) . '.');
        }
    }

    /**
     * @param string $key
     * @param mixed $fallback
     * @return mixed
     */
    public function fallback(string $key, $fallback = null) {
        return $this->parameters[$key] ?? $fallback;
    }
}