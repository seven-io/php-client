<?php declare(strict_types=1);

namespace Sms77\Tests\Client;

use Sms77\Api\Params\VoiceParams;
use Sms77\Api\Response\Voice;

class VoiceTest extends BaseTest {
    public function testVoice(): void {
        $str = $this->voice(false);
        $lines = explode(PHP_EOL, $str);
        [$code, $id, $cost] = $lines;

        self::assertIsString($str);
        self::assertCount(3, $lines);
        self::assertEquals('100', $code);

        $id = (int)$id;
        $cost = (float)$cost;
        if ($this->isDebug) {
            self::assertEquals(123456789, $id);
            self::assertEquals(0, $cost);
        } else {
            self::assertGreaterThan(0, $id);
            self::assertGreaterThan(0, $cost);
        }
    }

    /**
     * @param bool $json
     * @param bool $xml
     * @return Voice|string
     */
    private function voice(bool $json, bool $xml = false) {
        return $this->client->voice((new VoiceParams)
            ->setText('The current time is' . time())
            ->setTo($this->recipient)
            ->setJson($json)
            ->setXml($xml)
        );
    }

    public function testVoiceJson(): void {
        $res = $this->voice(true);

        self::assertIsObject($res);
        self::assertInstanceOf(Voice::class, $res);
        self::assertVoice($res);
    }

    private static function assertVoice(Voice $v): void {
        self::assertEquals(100, $v->success);

        self::assertCount(1, $v->messages);
        $msg = $v->messages[0];
        self::assertIsInt($msg->id);
        self::assertGreaterThan(0, $msg->id);

        self::assertIsFloat($v->total_price);
        self::assertGreaterThan(0, $v->total_price);
    }
}