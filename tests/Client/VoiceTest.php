<?php declare(strict_types=1);

namespace Seven\Tests\Client;

use Seven\Api\Params\VoiceParams;
use Seven\Api\Response\Voice\Voice;

class VoiceTest extends BaseTest {
    public function testVoice(): void {
        $res = $this->client->voice->post($this->params);

        $this->assertVoice($res);
    }

    private function assertVoice(Voice $v, bool $sandbox = false): void {
        $this->assertEquals(100, $v->getSuccess());

        $this->assertCount(1, $v->getMessages());
        $msg = $v->getMessages()[0];
        $this->assertIsInt($msg->getId());
        $this->assertGreaterThan(0, $msg->getId());

        $this->assertIsFloat($v->getTotalPrice());
        if ($sandbox) $this->assertEquals(0.0, $v->getTotalPrice());
        else $this->assertGreaterThanOrEqual(0, $v->getTotalPrice());
    }

    public function testVoiceSandbox(): void {
        $this->toSandbox();
        $params = (clone $this->params);
        $res = $this->client->voice->post($params);

        $this->assertVoice($res, true);
    }

    protected function setUp(): void {
        $this->params = new VoiceParams('The current time is' . time(), '491716992343');
    }
}
