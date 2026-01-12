<?php declare(strict_types=1);

namespace Seven\Tests;

use DateTime;
use Exception;
use PHPUnit\Framework\TestCase;
use Seven\Api\Client;

abstract class AbstractTestCase extends TestCase {
    protected const DEFAULT_TEST_RECIPIENT = '491716992343';

    protected bool $isSandbox;
    protected readonly Resources $resources;
    protected Client $client;
    protected string $testRecipient;

    public  function setUp(): void {
        $this->init(getenv('SEVEN_API_KEY'), false);
    }

    protected function init(string $apiKey, bool $isSandbox): void {
        $signingSecret = getenv('SEVEN_SIGNING_SECRET');
        $this->client = new Client($apiKey, 'php-api-test', $signingSecret ?: null);
        $this->resources = new Resources($this->client);
        $this->isSandbox = $isSandbox;
        $this->testRecipient = getenv('SEVEN_TEST_RECIPIENT') ?: self::DEFAULT_TEST_RECIPIENT;
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
