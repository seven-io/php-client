<?php declare(strict_types=1);

namespace Seven\Tests;

use InvalidArgumentException;
use Seven\Api\Client;

class ClientTest extends AbstractTestCase
{
    public function testClient(): void
    {
        self::assertGreaterThan(0, strlen($this->resources->client->getApiKey()));

        self::assertGreaterThan(0, strlen($this->resources->client->getSentWith()));
    }

    public function testClientWithBadCredentials(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Client('', '');
    }
}
