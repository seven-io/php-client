<?php declare(strict_types=1);

namespace Seven\Api\Exception;

use Exception;

class ForbiddenIpException extends Exception
{
    public function __construct($message = 'The server IP is not included in the list of permitted IP addresses', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}" . PHP_EOL;
    }
}
