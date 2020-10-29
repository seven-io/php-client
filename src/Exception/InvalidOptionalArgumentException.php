<?php declare(strict_types=1);

namespace Sms77\Api\Exception;

use Exception;

class InvalidOptionalArgumentException extends Exception {
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    /** @return string */
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}" . PHP_EOL;
    }
}