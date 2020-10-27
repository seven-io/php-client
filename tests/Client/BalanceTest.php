<?php

namespace Sms77\Tests\Client;

class BalanceTest extends BaseTest
{
    public function testBalance()
    {
        $res = $this->client->balance();
        $res = json_decode($res);

        self::assertTrue(is_float($res));
    }
}