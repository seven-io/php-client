<?php declare(strict_types=1);

namespace Seven\Tests;

use DateTime;
use Exception;
use PHPUnit\Framework\TestCase;
use Seven\Api\Client;

abstract class BaseTest extends TestCase {
    protected bool $isSandbox;
    protected readonly Resources $resources;
    protected Client $client;

    public  function setUp(): void {
        $this->init(getenv('SEVEN_API_KEY'), false);
    }

    protected function init(string $apiKey, bool $isSandbox): void {
        $this->client = new Client($apiKey, 'php-api-test', getenv('SEVEN_SIGNING_SECRET'));
        $this->resources = new Resources($this->client);
        $this->isSandbox = $isSandbox;
    }

    public static function createRandomURL(string $uri = 'https://php.tld/'): string {
        return $uri . uniqid('', true);
    }

    public static function assertIsValidDateTime(string $dateTime): void {
        $bool = null;

        try {
            $bool = new DateTime($dateTime);
        } catch (Exception) {
        }

        self::assertInstanceOf(DateTime::class, $bool);
    }

    public function toSandbox(): void {
        $this->init(getenv('SEVEN_API_KEY_SANDBOX'), true);
    }

    public function assertIsNullOrString($value): void {
        $this->assertTrue(is_string($value) || is_null($value));
    }

    public function assertIsNullOrLengthyString(?string $value): void {
        $this->assertTrue(is_null($value) || 0 < strlen($value));
    }
}
