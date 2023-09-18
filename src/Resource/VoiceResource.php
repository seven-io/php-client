<?php

namespace Seven\Api\Resource;

use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Params\VoiceParams;
use Seven\Api\Response\Voice\Voice;
use Seven\Api\Validator\VoiceValidator;

class VoiceResource extends Resource {
    /**
     * @throws InvalidRequiredArgumentException
     */
    public function post(VoiceParams $params): Voice {
        $this->validate($params);

        $res = $this->client->post('voice', array_merge($params->toArray(), ['json' => true]));

        return new Voice($res);
    }

    /**
     * @param VoiceParams $params
     * @throws InvalidRequiredArgumentException
     */
    public function validate($params): void {
        (new VoiceValidator($params))->validate();
    }
}
