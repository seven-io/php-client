<?php

namespace Sms77\Tests\Client;

class StatusTest extends BaseTest
{
    function testStatus()
    {
        $res = $this->client->status("77120101060");

        $this->assertStringStartsWith('DELIVERED', $res);
    }
}