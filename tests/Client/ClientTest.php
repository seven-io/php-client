<?php declare(strict_types=1);

namespace Sms77\Tests\Client;

use InvalidArgumentException;
use Sms77\Api\Client;

class ClientTest extends BaseTest {
    public function testClient(): void {
        self::assertGreaterThan(0, strlen($this->client->getApiKey()));

        self::assertGreaterThan(0, strlen($this->client->getSentWith()));
    }

    public function testClientWithBadCredentials(): void {
        $this->expectException(InvalidArgumentException::class);

        new Client('', '');
    }
}