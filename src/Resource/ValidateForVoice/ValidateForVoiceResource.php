<?php declare(strict_types=1);

namespace Seven\Api\Resource\ValidateForVoice;

use Random\RandomException;
use Seven\Api\Exception\ForbiddenIpException;
use Seven\Api\Exception\InvalidApiKeyException;
use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Exception\MissingAccessRightsException;
use Seven\Api\Exception\SigningHashVerificationException;
use Seven\Api\Exception\UnexpectedApiResponseException;
use Seven\Api\Resource\Resource;
use Seven\Api\Validator\ValidateForVoiceValidator;

class ValidateForVoiceResource extends Resource {
    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     * @throws RandomException
     * @throws ForbiddenIpException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     */
    public function post(ValidateForVoiceParams $params): ValidateForVoice {
        $this->validate($params);

        $res = $this->client->post('validate_for_voice', $params->toArray());

        return new ValidateForVoice($res);
    }

    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function validate(ValidateForVoiceParams $params): void {
        (new ValidateForVoiceValidator($params))->validate();
    }
}
