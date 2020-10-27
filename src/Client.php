<?php

namespace Sms77\Api;

use Exception;
use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Validator\AnalyticsValidator;
use Sms77\Api\Validator\ContactsValidator;
use Sms77\Api\Validator\LookupValidator;
use Sms77\Api\Validator\PricingValidator;
use Sms77\Api\Validator\SmsValidator;
use Sms77\Api\Validator\StatusValidator;
use Sms77\Api\Validator\ValidateForVoiceValidator;
use Sms77\Api\Validator\VoiceValidator;

class Client {
    const BASE_URI = 'https://gateway.sms77.io/api';

    /* @var string $apiKey */
    protected $apiKey;
    /* @var string $sendWith */
    protected $sendWith;

    /**
     * @param string $apiKey
     * @param string $sendWith
     * @throws Exception
     */
    public function __construct($apiKey, $sendWith = 'php-api') {
        $this->apiKey = $apiKey;
        $this->sendWith = $sendWith;

        if ('' === $apiKey || !is_string($apiKey)) {
            throw new Exception('Missing required constructor argument apiKey!');
        }

        if ('' === $sendWith || !is_string($sendWith)) {
            throw new Exception('Missing required constructor argument sendWith!');
        }
    }

    /**
     * @param array $options
     * @return bool|string
     * @throws InvalidOptionalArgumentException
     */
    public function analytics(array $options = []) {
        (new AnalyticsValidator($options))->validate();

        return $this->request('analytics', $options);
    }

    /**
     * @param $path
     * @param array $options
     * @return bool|string
     */
    private function request($path, $options = []) {
        $curl_get_contents = static function ($url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            return $output;
        };

        return $curl_get_contents(self::BASE_URI . '/' . $path
            . '?' . http_build_query(array_merge($options, [
                'p' => $this->apiKey,
                'sendwith' => '' === $this->sendWith ? 'unknown' : $this->sendWith,
            ])));
    }

    /**
     * @return bool|string
     */
    public function balance() {
        return $this->request('balance');
    }

    /**
     * @param $action
     * @param array $extra
     * @return bool|string
     * @throws Exception\InvalidRequiredArgumentException
     */
    public function contacts($action, array $extra = []) {
        $options = array_merge([
            'action' => $action,
        ], $extra);

        (new ContactsValidator($options))->validate();

        return $this->request('contacts', $options);
    }

    /**
     * @param $type
     * @param $number
     * @param array $extra
     * @return bool|string
     * @throws Exception\InvalidRequiredArgumentException
     */
    public function lookup($type, $number, array $extra = []) {
        $options = array_merge([
            'type' => $type,
            'number' => $number,
        ], $extra);

        (new LookupValidator($options))->validate();

        return $this->request('lookup', $options);
    }

    /**
     * @param array $options
     * @return bool|string
     * @throws Exception\InvalidRequiredArgumentException
     */
    public function pricing(array $options = []) {
        (new PricingValidator($options))->validate();

        return $this->request('pricing', $options);
    }

    /**
     * @param $to
     * @param $text
     * @param array $extra
     * @return bool|string
     * @throws Exception\InvalidRequiredArgumentException
     */
    public function sms($to, $text, array $extra = []) {
        $options = array_merge([
            'to' => $to,
            'text' => $text,
        ], $extra);

        (new SmsValidator($options))->validate();

        return $this->request('sms', $options);
    }

    /**
     * @param $msgId
     * @return bool|string
     * @throws Exception\InvalidRequiredArgumentException
     */
    public function status($msgId) {
        $options = [
            'msg_id' => $msgId,
        ];

        (new StatusValidator($options))->validate();

        return $this->request('status', $options);
    }

    /**
     * @param $number
     * @param array $extra
     * @return bool|string
     * @throws Exception\InvalidRequiredArgumentException
     */
    public function validateForVoice($number, array $extra = []) {
        $options = array_merge([
            'number' => $number,
        ], $extra);

        (new ValidateForVoiceValidator($options))->validate();

        return $this->request('validate_for_voice', $options);
    }

    /**
     * @param $to
     * @param $text
     * @param array $extra
     * @return bool|string
     * @throws Exception\InvalidRequiredArgumentException
     */
    public function voice($to, $text, array $extra = []) {
        $options = array_merge([
            'to' => $to,
            'text' => $text,
        ], $extra);

        (new VoiceValidator($options))->validate();

        return $this->request('voice', $options);
    }

    /** @return string */
    public function getApiKey() {
        return $this->apiKey;
    }

    /** @return string */
    public function getSendWith() {
        return $this->sendWith;
    }
}