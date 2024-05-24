<?php declare(strict_types=1);

namespace Seven\Tests;

use Seven\Api\Resource\ValidateForVoice\ValidateForVoiceParams;

class ValidateForVoiceTest extends BaseTest {
    public function testValidateForVoice(): void {
        $params = (new ValidateForVoiceParams('491716992343'))
            ->setCallback('https://seven.dev/callback/validate_for_voice');
        $res = $this->resources->validateForVoice->post($params);

        $this->assertTrue($res->isSuccess());
    }

    public function testValidateForVoiceFaulty(): void {
        $faultySenderNumber = '0';
        $params = new ValidateForVoiceParams($faultySenderNumber);
        $voice = $this->resources->validateForVoice->post($params);

        $this->assertIsNullOrLengthyString($voice->getError());
        $this->assertTrue($voice->getFormattedOutput() == null || $voice->getFormattedOutput() !== '');
        $this->assertTrue($voice->getId() === null || $voice->getId() > 0);
        $this->assertEquals($faultySenderNumber, $voice->getSender());
        $this->assertFalse($voice->isSuccess());
        $this->assertFalse($voice->isVoice());
    }
}
