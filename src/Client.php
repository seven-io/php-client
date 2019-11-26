<?php

namespace Sms77\Api;

use Sms77\Api\Validator\ContactsValidator;
use Sms77\Api\Validator\LookupValidator;
use Sms77\Api\Validator\SmsValidator;
use Sms77\Api\Validator\StatusValidator;
use Sms77\Api\Validator\ValidateForVoiceValidator;
use Sms77\Api\Validator\VoiceValidator;

class Client
{
    /* @var string $apiKey */
    private $apiKey;

    const BASE_URI = 'https://gateway.sms77.io/api';

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    function balance()
    {
        return $this->request("balance");
    }

    function contacts($action, array $extra = [])
    {
        $options = $this->buildOptions([
            "action" => $action,
        ], $extra);

        (new ContactsValidator($options))->validate();

        return $this->request("contacts", $options);
    }

    function lookup($type, $number, array $extra = [])
    {
        $options = $this->buildOptions([
            "type" => $type,
            "number" => $number,
        ], $extra);

        (new LookupValidator($options))->validate();

        return $this->request("lookup", $options);
    }

    /*TODO: add add validation*/
    function pricing(array $extra = [])
    {
        $required = [];

        $options = array_merge($required, $extra);

        return $this->request("pricing", $options);
    }

    function sms($to, $text, array $extra = [])
    {
        $options = $this->buildOptions([
            "to" => $to,
            "text" => $text
        ], $extra);

        (new SmsValidator($options))->validate();

        return $this->request("sms", $options);
    }

    function status($msgId)
    {
        $options = $this->buildOptions([
            "msg_id" => $msgId,
        ]);

        (new StatusValidator($options))->validate();

        return $this->request("status", $options);
    }

    function validateForVoice($number, array $extra = [])
    {
        $options = $this->buildOptions([
            "number" => $number,
        ], $extra);

        (new ValidateForVoiceValidator($options))->validate();

        return $this->request("validate_for_voice", $options);
    }

    function voice($to, $text, array $extra = [])
    {
        $options = $this->buildOptions([
            "to" => $to,
            "text" => $text
        ], $extra);

        (new VoiceValidator($options))->validate();

        return $this->request("voice", $options);
    }

    private function buildOptions(array $required, array $extra = [])
    {
        $required = array_merge($required, [
            "p" => $this->apiKey
        ]);

        return array_merge($required, $extra);
    }

    private function request($path, $options = [])
    {
        return file_get_contents(self::BASE_URI . "/" . $path . "?" . http_build_query($options));
    }
}