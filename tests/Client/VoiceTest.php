<?php

namespace Sms77\Tests\Client;

class VoiceTest extends BaseTest
{
    public function testVoice()
    {
        $voice = $this->client->voice($this->recipient, time());

        $this->assertIsString($voice);

        $voice = explode(PHP_EOL, $voice);

        $this->assertArrayHasKey(0, $voice);
        $this->assertEquals(self::SUCCESS_CODE, (int)$voice[0]);

        $this->assertArrayHasKey(1, $voice);
        $this->assertIsInt((int)$voice[1]);

        $this->assertArrayHasKey(2, $voice);
        $this->assertIsFloat((float)$voice[2]);
    }
}