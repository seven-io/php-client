<?php

namespace Sms77\Tests\Client;

class VoiceTest extends BaseTest
{
    public function testVoice()
    {
        $voice = $this->client->voice($this->recipient, time());

        $this->assertTrue(is_string($voice));

        $voice = explode(PHP_EOL, $voice);

        $this->assertArrayHasKey(0, $voice);
        $this->assertEquals(self::SUCCESS_CODE, (int)$voice[0]);

        $this->assertArrayHasKey(1, $voice);
        $this->assertTrue(is_integer((int)$voice[1]));

        $this->assertArrayHasKey(2, $voice);
        $this->assertTrue(is_float((float)$voice[2]));
    }
}