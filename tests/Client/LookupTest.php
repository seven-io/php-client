<?php

namespace Sms77\Tests\Client;

class LookupTest extends BaseTest
{
    function testLookup()
    {
        $res = $this->client->lookup("format", $this->recipient);
        $res = json_decode($res);

        $this->assertObjectHasAttribute('success', $res);
        $this->assertTrue($res->success);
    }
}