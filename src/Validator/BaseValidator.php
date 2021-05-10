<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidBooleanOptionException;
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

    public static function isValidDate(string $date): bool {
        return Util::isValidDate($date, 'Y-m-d');
    }

    public function isValidBool($string): bool {
        $string = (int)$string;

        return 1 === $string || 0 === $string;
    }

    /**
     * @param string $key
     * @param mixed $fallback
     * @return mixed
     */
    public function fallback(string $key, $fallback = null) {
        return $this->parameters[$key] ?? $fallback;
    }

    /** @throws InvalidBooleanOptionException */
    protected function validate(): void {
        foreach ($this->boolOptions as $k) {
            $v = $this->toBool($k, $this->parameters[$k] ?? null);

            if (null === $v) {
                continue;
            }

            $this->parameters[$k] = $v;
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
}