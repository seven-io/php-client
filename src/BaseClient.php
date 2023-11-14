<?php declare(strict_types=1);

namespace Seven\Api;

use Exception;
use InvalidArgumentException;
use Seven\Api\Constant\HttpMethod;
use UnexpectedValueException;

abstract class BaseClient {
    public const BASE_URI = 'https://gateway.seven.io/api';

    protected string $apiKey;
    protected string $sentWith;

    /**
     * @throws Exception
     */
    public function __construct(string $apiKey, string $sentWith = 'php-api') {
        $this->apiKey = $apiKey;
        $this->sentWith = $sentWith;

        if ('' === $apiKey) throw new InvalidArgumentException(
            "Invalid required constructor argument apiKey: $apiKey");

        if ('' === $sentWith || !is_string($sentWith)) throw new InvalidArgumentException(
            "Invalid required constructor argument sentWith: $sentWith");
    }

    public function getApiKey(): string {
        return $this->apiKey;
    }

    public function getSentWith(): string {
        return $this->sentWith;
    }

    /**
     * @return mixed
     */
    public function delete(string $path, array $options = []) {
        return $this->request($path, HttpMethod::DELETE, $options);
    }

    /**
     * @return mixed
     */
    protected function request(string $path, string $method, array $options = []) {
        $method = strtoupper($method);
        $methods = HttpMethod::values();
        if (!in_array($method, $methods)) {
            $methods = implode(',', $methods);

            throw new InvalidArgumentException(
                "Invalid method '$method' - valid methods are $methods");
        }

        $headers = [
            'Accept: application/json',
            'Content-Type: application/json',
            "SentWith: $this->sentWith",
            "X-Api-Key: $this->apiKey",
        ];
        $url = self::BASE_URI . "/$path";
        $params = http_build_query($options);
        if (HttpMethod::GET === $method) $url .= "?$params";

        $ch = curl_init($url);

        if (HttpMethod::POST === $method) {
            $params = stripslashes(json_encode($options, JSON_UNESCAPED_UNICODE));

            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_POST, true);
        }

        if (HttpMethod::DELETE === $method)
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, HttpMethod::DELETE);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array_unique($headers));

        $res = curl_exec($ch);

        curl_close($ch);

        if (false === $res) throw new UnexpectedValueException(curl_error($ch));

        try {
            $res = json_decode($res, false, 512, JSON_THROW_ON_ERROR);
        } catch (Exception $e) {
        }

        return $res;
    }

    /**
     * @return mixed
     */
    public function post(string $path, array $options = []) {
        return $this->request($path, HttpMethod::POST, $options);
    }

    /**
     * @return mixed
     */
    public function get(string $path, array $options = []) {
        return $this->request($path, HttpMethod::GET, $options);
    }
}
