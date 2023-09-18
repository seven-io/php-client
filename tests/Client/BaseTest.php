<?php declare(strict_types=1);

namespace Seven\Tests\Client;

use DateTime;
use Exception;
use PHPUnit\Framework\TestCase;
use Seven\Api\Client;

abstract class BaseTest extends TestCase {
    protected Client $client;
    protected bool $isDebug;

    public function __construct() {
        parent::__construct();

        $this->init(getenv('SEVEN_API_KEY'), false);
    }

    protected function init(string $apiKey, bool $isDebug): void {
        $this->client = new Client($apiKey, 'php-api-test');

        $this->isDebug = $isDebug;
    }

    public static function createRandomURL(string $uri = 'https://my.tld/'): string {
        return $uri . uniqid('', true);
    }

    public static function assertIsValidDateTime(string $dateTime): void {
        $bool = null;

        try {
            $bool = new DateTime($dateTime);
        } catch (Exception $e) {
        }

        self::assertInstanceOf(DateTime::class, $bool);
    }

    public function assertIsNullOrString($value): void {
        $this->assertTrue(is_string($value) || is_null($value));
    }

    public function assertIsNullOrLengthyString(?string $value): void {
        $this->assertTrue(is_null($value) || 0 < strlen($value));
    }

    public function assertIsLengthyString(string $value): void {
        $this->assertIsString($value);
        $this->assertTrue($value !== '');
    }
}
