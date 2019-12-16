<?php

namespace Sms77\Tests\Client;

class SmsTest extends BaseTest
{
    public function testSms()
    {
        $res = $this->client->sms($this->recipient, 'HI2U! The UNIX time is ' . time() . '.');
        $res = json_decode($res, false);

        $this->assertEquals(self::SUCCESS_CODE, $res);
    }
}