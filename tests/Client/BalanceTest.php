<?php declare(strict_types=1);

namespace Seven\Tests\Client;

class BalanceTest extends BaseTest {
    public function testBalance(): void {
        $res = $this->client->balance->get();

        $this->assertNotEmpty($res->getCurrency());
    }
}
