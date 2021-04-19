<?php declare(strict_types=1);

namespace Sms77\Tests\Client;

use DateTime;
use PHPUnit\Framework\TestCase;
use Sms77\Api\Client;

abstract class BaseTest extends TestCase {
    protected $client;
    protected $recipient;
    protected $isDebug;

    public function __construct() {
        parent::__construct(null, [], '');

        $this->init(getenv('SMS77_API_KEY'), false);

        $this->recipient = getenv('SMS77_RECIPIENT') ?? '+491716992343';
    }

    protected function init(string $apiKey, bool $isDebug): void {
        $this->client = new Client($apiKey, 'php-api-test');

        $this->isDebug = $isDebug;
    }

    public static function createRandomURL(string $uri = 'https://my.tld/'): string {
        return $uri . uniqid('', true);
    }

    public static function assertIsNullOrLengthyString(?string $value): void {
        self::assertTrue(is_null($value) || 0 < strlen($value));
    }

    public static function assertIsLengthyString(string $value): void {
        self::assertIsString($value);
        self::assertNotEmpty($value);
    }

    public static function assertIsValidDateTime(string $dateTime): void {
        $bool = null;

        try {
            $bool = new DateTime($dateTime);
        } catch (\Exception $e) {
        }

        self::assertInstanceOf(DateTime::class, $bool);
    }
}