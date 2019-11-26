<?php

namespace Sms77\Tests\Client;

class BalanceTest extends BaseTest
{
    function testBalance()
    {
        $res = $this->client->balance();
        $res = json_decode($res);

        $this->assertTrue(is_double($res));
    }
}