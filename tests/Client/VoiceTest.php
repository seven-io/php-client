<?php declare(strict_types=1);

namespace Sms77\Tests\Client;

use Sms77\Api\Response\Voice;

class VoiceTest extends BaseTest {
    public function testVoice(): void {
        $res = $this->voice(false);

        self::assertIsString($res);

        self::assertVoice(new Voice($res));
    }

    private function voice(bool $json) {
        return $this->client->voice($this->recipient, (string)time(), false, $json);
    }

    private static function assertVoice(Voice $v): void {
        self::assertEquals(100, $v->code);

        self::assertIsInt($v->id);
        self::assertGreaterThan(0, $v->id);

        self::assertIsFloat($v->price);
        self::assertGreaterThan(0, $v->price);
    }

    public function testVoiceJson(): void {
        $res = $this->voice(true);

        self::assertIsObject($res);
        self::assertInstanceOf(Voice::class, $res);
        self::assertVoice($res);
    }
}