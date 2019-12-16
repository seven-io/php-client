<?php

namespace Sms77\Tests\Client;

class BalanceTest extends BaseTest
{
    public function testBalance()
    {
        $res = $this->client->balance();
        $res = json_decode($res, false);

        $this->assertTrue(is_float($res));
    }
}