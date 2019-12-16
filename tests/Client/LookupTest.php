<?php

namespace Sms77\Tests\Client;

class LookupTest extends BaseTest
{
    public function testLookup()
    {
        $res = $this->client->lookup('format', $this->recipient);
        $res = json_decode($res, false);

        $this->assertObjectHasAttribute('success', $res);
        $this->assertTrue($res->success);
    }
}