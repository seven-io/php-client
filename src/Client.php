<?php

namespace Sms77\Api;

use Sms77\Api\Validator\ContactsValidator;
use Sms77\Api\Validator\LookupValidator;
use Sms77\Api\Validator\SmsValidator;

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

    /*TODO: add add validation*/
    function status($msgId)
    {
        $required = [
            "msg_id" => $msgId,
        ];

        $options = array_merge($required);

        return $this->request("status", $options);
    }

    /*TODO: add add validation*/
    function validateForVoice($number, array $extra = [])
    {
        $required = [
            "number" => $number,
        ];

        $options = array_merge($required, $extra);

        return $this->request("validate_for_voice", $options);
    }

    /*TODO: add add validation*/
    function voice($to, $text, array $extra = [])
    {
        $required = [
            "to" => $to,
            "text" => $text,
        ];

        $options = array_merge($required, $extra);

        return $this->request("voice", $options);
    }

    private function buildOptions(array $required, array $extra)
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