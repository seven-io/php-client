<?php declare(strict_types=1);

namespace Seven\Api\Exception;

use Exception;

class MissingAccessRightsException extends Exception
{
    public function __construct($message = 'The API key does not have access rights to this endpoint.', $code = 902, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}" . PHP_EOL;
    }
}
