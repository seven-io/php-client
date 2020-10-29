<?php declare(strict_types=1);

namespace Sms77\Tests\Client;

use Sms77\Api\Response\Balance;

class BalanceTest extends BaseTest {
    public function testBalance(): void {
        self::assertIsFloat($this->balance(false));
    }

    private function balance(bool $json) {
        return $this->client->balance($json);
    }

    public function testBalanceJson(): void {
        $res = $this->balance(true);

        self::assertInstanceOf(Balance::class, $res);
        self::assertIsFloat($res->balance);
    }
}