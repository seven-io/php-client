<?php declare(strict_types=1);

namespace Seven\Api\Exception;

use Exception;

/**
 * Exception thrown when the API returns an error code instead of a successful response.
 */
class ApiException extends Exception
{
    private const ERROR_MESSAGES = [
        100 => 'SMS has been accepted by the gateway and is being sent.',
        101 => 'Sending to at least one recipient failed.',
        201 => 'Sender invalid. A maximum of 11 alphanumeric or 16 numeric characters are permitted.',
        202 => 'The recipient number is invalid.',
        301 => 'Parameter "to" not set.',
        302 => 'Parameter "text" is invalid.',
        303 => 'Parameter "text" is too long.',
        304 => 'No route available.',
        305 => 'Flash SMS not available.',
        400 => 'Invalid message ID.',
        401 => 'Message limit exceeded.',
        402 => 'Limit for recipient numbers exceeded.',
        403 => 'Rate limit exceeded.',
        500 => 'Insufficient account credit.',
        600 => 'Sending error occurred.',
        700 => 'Balance query failed.',
        801 => 'Logo upload failed.',
        802 => 'Invalid label provided.',
        900 => 'Invalid API key.',
        901 => 'Signing hash verification failed.',
        902 => 'Missing access rights.',
        903 => 'Forbidden IP.',
    ];

    public function __construct(int $code, ?string $customMessage = null, ?Exception $previous = null)
    {
        $message = $customMessage ?? self::ERROR_MESSAGES[$code] ?? "Unknown API error code: $code";
        parent::__construct($message, $code, $previous);
    }

    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}" . PHP_EOL;
    }

    /**
     * Check if the given code is a known API error code.
     */
    public static function isKnownErrorCode(int $code): bool
    {
        return isset(self::ERROR_MESSAGES[$code]);
    }

    /**
     * Check if the given code indicates a successful operation (code 100).
     * Note: Code 100 means "accepted by gateway", not necessarily delivered.
     */
    public static function isSuccessCode(int $code): bool
    {
        return $code === 100;
    }

    /**
     * Get the error message for a given code.
     */
    public static function getMessageForCode(int $code): ?string
    {
        return self::ERROR_MESSAGES[$code] ?? null;
    }
}
