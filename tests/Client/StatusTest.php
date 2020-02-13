<?php

namespace Sms77\Tests\Client;

use DateTime;
use Sms77\Api\Constants;

class StatusTest extends BaseTest
{
    public function testStatus()
    {
        $response = $this->client->status(getenv('SMS77_MSG_ID'));

        $lines = explode(PHP_EOL, $response);
        $status = $lines[0];
        $timestamp = $lines[1];

        $this->assertTrue(in_array($status, Constants::statusMessages));

        $this->assertInstanceOf('DateTime', new DateTime($timestamp));
    }
}