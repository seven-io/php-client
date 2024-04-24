<?php declare(strict_types=1);

namespace Seven\Api\Resource;

use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Params\VoiceParams;
use Seven\Api\Response\Voice\Voice;
use Seven\Api\Validator\VoiceValidator;

class VoiceResource extends Resource
{
    /**
     * @param VoiceParams $params
     * @return Voice
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function call(VoiceParams $params): Voice
    {
        $this->validate($params);

        $res = $this->client->post('voice', $params->toArray());

        return new Voice($res);
    }

    /**
     * @param VoiceParams $params
     * @throws InvalidRequiredArgumentException
     * @throws InvalidOptionalArgumentException
     */
    public function validate($params): void
    {
        (new VoiceValidator($params))->validate();
    }
}
