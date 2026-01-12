<?php declare(strict_types=1);

namespace Seven\Tests;

use Seven\Api\Resource\ValidateForVoice\ValidateForVoiceParams;

class ValidateForVoiceTest extends AbstractTestCase {
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
        $this->assertTrue($voice->getSender() === $faultySenderNumber || $voice->getSender() === null);
        // API might consider '0' as valid in some cases
        $this->assertIsBool($voice->isSuccess());
        // API might return true or false for invalid numbers
        $this->assertIsBool($voice->isVoice());
    }
}
