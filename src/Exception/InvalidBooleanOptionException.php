<?php declare(strict_types=1);

namespace Sms77\Api\Exception;

use Exception;

class InvalidBooleanOptionException extends Exception {
    /** @var string $key */
    private $key;

    /** @var mixed $value */
    private $value;

    public function __construct(string $key, $value) {
        $this->key = $key;
        $this->value = $value;

        parent::__construct();
    }

    /** @return string */
    public function __toString() {
        return __CLASS__
            . "Invalid boolean option $this->key must be 0, 1, false or true "
            . "but received $this->value instead"
            . PHP_EOL;
    }
}