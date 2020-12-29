<?php declare(strict_types=1);

namespace Sms77\Tests\Client;

use DateTime;
use PHPUnit\Framework\TestCase;
use Sms77\Api\Client;

abstract class BaseTest extends TestCase {
    protected $client;
    protected $recipient;

    public function __construct(
        ?string $name = null, array $data = [], string $dataName = '') {
        parent::__construct($name, $data, $dataName);

        $this->client = new Client(getenv('SMS77_API_KEY'), 'php-api-test');

        $this->recipient = getenv('SMS77_RECIPIENT') ?? '+491771783130';
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