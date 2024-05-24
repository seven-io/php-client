<?php declare(strict_types=1);

namespace Seven\Api\Resource\Voice;

use Random\RandomException;
use Seven\Api\Exception\ForbiddenIpException;
use Seven\Api\Exception\InvalidApiKeyException;
use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Exception\MissingAccessRightsException;
use Seven\Api\Exception\SigningHashVerificationException;
use Seven\Api\Exception\UnexpectedApiResponseException;
use Seven\Api\Resource\Resource;
use Seven\Api\Response\Voice\Voice;
use Seven\Api\Validator\VoiceValidator;

class VoiceResource extends Resource {
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
    public function call(VoiceParams $params): Voice {
        $this->validate($params);

        $res = $this->client->post('voice', $params->toArray());

        return new Voice($res);
    }

    /**
     * @throws InvalidRequiredArgumentException
     * @throws InvalidOptionalArgumentException
     */
    public function validate(VoiceParams $params): void {
        (new VoiceValidator($params))->validate();
    }
}
