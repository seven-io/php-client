<?php
declare(strict_types=1);

namespace Sms77\Api;

class Api
{
    private $apiKey;
    /* @var string */

    private const ENDPOINT = 'https://gateway.sms77.io/api/sms?';

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    function send(string $to, string $text, array $extra = [])
    {
        $required = [
            "to" => $to,
            "text" => $text
        ];

        $options = array_merge($required, $extra);

        $validator = new Validator($options);
        $validator->validate();
        return $this->get($options);
    }

    private function get($options)
    {
        $options = array_merge($options, ["p" => $this->apiKey]);

        return file_get_contents(self::ENDPOINT . http_build_query($options));
    }
}