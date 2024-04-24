<?php declare(strict_types=1);

namespace Seven\Api\Resource;

use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Params\ValidateForVoiceParams;
use Seven\Api\Response\ValidateForVoice;
use Seven\Api\Validator\ValidateForVoiceValidator;

class ValidateForVoiceResource extends Resource
{
    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function post(ValidateForVoiceParams $params): ValidateForVoice
    {
        $this->validate($params);

        $res = $this->client->post('validate_for_voice', $params->toArray());

        return new ValidateForVoice($res);
    }

    /**
     * @param ValidateForVoiceParams $params
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function validate($params): void
    {
        (new ValidateForVoiceValidator($params))->validate();
    }
}
