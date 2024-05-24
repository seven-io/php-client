<?php declare(strict_types=1);

namespace Seven\Tests;

use Seven\Api\Resource\Voice\Voice;
use Seven\Api\Resource\Voice\VoiceParams;

class VoiceTest extends BaseTest {
    public function testVoice(): void {
        $params = new VoiceParams('The current time is' . time(), '491716992343');
        $res = $this->resources->voice->call($params);

        $this->assertVoice($res);
    }

    private function assertVoice(Voice $v): void {
        $this->assertEquals(100, $v->getSuccess());

        $this->assertCount(1, $v->getMessages());
        $msg = $v->getMessages()[0];
        $this->assertIsInt($msg->getId());
        $this->assertGreaterThan(0, $msg->getId());
        $this->assertIsFloat($v->getTotalPrice());
        $this->assertGreaterThanOrEqual(0, $v->getTotalPrice());
    }
}
