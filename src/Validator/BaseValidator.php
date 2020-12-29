<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Constant\SmsType;
use Sms77\Api\Exception\InvalidBooleanOptionException;
use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Library\Util;

abstract class BaseValidator {
    /* @var array $parameters */
    protected $parameters;

    /* @var array $boolOptions */
    private $boolOptions;

    public function __construct(array $parameters = [], array $boolOptions = []) {
        $this->parameters = $parameters;
        $this->boolOptions = $boolOptions;
    }

    /** @throws InvalidBooleanOptionException */
    protected function validate(): void {
        foreach ($this->boolOptions as $k) {
            $v = $this->toBool($k, $this->parameters[$k] ?? null);

            if (null !== $v) {
                $this->parameters[$k] = $v;
            }
        }
    }

    /** @throws InvalidBooleanOptionException */
    private function toBool(string $k, $v): ?int {
        if (null === $v) {
            return null;
        }

        $str = (string)$v;

        if ('1' === $str || true === $v) {
            return 1;
        }

        if ('0' === $str || false === $v) {
            return 0;
        }

        throw new InvalidBooleanOptionException($k, $v);
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