<?php declare(strict_types=1);

namespace Sms77\Tests\Client;

class ValidateForVoiceTest extends BaseTest {
    public function testVoice(): void {
        $res = $this->client->validateForVoice($this->recipient,
            ['callback' => 'http://my.site/validate_for_voice']);

        self::assertIsObject($res);
        self::assertIsBool($res->success);
        self::assertIsInt($res->code);
        self::assertGreaterThan(0, $res->code);
    }

    public function testVoiceFaulty(): void {
        $faultySenderNumber = '123';
        $voice = $this->client->validateForVoice($faultySenderNumber);

        self::assertIsObject($voice);
        self::assertIsString($voice->error);
        self::assertIsString($voice->formatted_output);
        self::assertNull($voice->id);
        self::assertEquals($faultySenderNumber, $voice->sender);
        self::assertFalse($voice->success);
        self::assertFalse($voice->voice);
    }
}