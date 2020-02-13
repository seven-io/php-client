<?php

namespace Sms77\Tests\Client;


class ValidateForVoiceTest extends BaseTest
{
    public function testVoice()
    {
        $voice = $this->client->validateForVoice($this->recipient, ['callback' => 'http://my.site/validate_for_voice']);
        $voice = json_decode($voice, false);

        $this->assertTrue(is_object($voice));

        $this->assertObjectHasAttribute('success', $voice);
        $this->assertTrue($voice->success);

        $this->assertObjectHasAttribute('code', $voice);
        $this->assertTrue(is_integer((int)$voice->code));

        $this->assertObjectHasAttribute('error', $voice);
        $this->assertNull($voice->error);
    }

    public function testVoiceFaulty()
    {
        $faultySenderNumber = '123';
        $voice = $this->client->validateForVoice($faultySenderNumber);
        $voice = json_decode($voice, false);

        $this->assertTrue(is_object($voice));

        $this->assertObjectHasAttribute('error', $voice);
        $this->assertTrue(is_string($voice->error));

        $this->assertObjectHasAttribute('formatted_output', $voice);
        $this->assertTrue(is_string($voice->formatted_output));

        $this->assertObjectHasAttribute('id', $voice);
        $this->assertNull($voice->id);

        $this->assertObjectHasAttribute('sender', $voice);
        $this->assertEquals($faultySenderNumber, $voice->sender);

        $this->assertObjectHasAttribute('success', $voice);
        $this->assertFalse($voice->success);

        $this->assertObjectHasAttribute('voice', $voice);
        $this->assertFalse($voice->voice);
    }
}