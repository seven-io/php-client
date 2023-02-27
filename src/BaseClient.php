<?php declare(strict_types=1);

namespace Sms77\Api;

use Exception;
use InvalidArgumentException;
use UnexpectedValueException;

abstract class BaseClient {
    public const HTTP_DELETE = 'DELETE';
    public const HTTP_GET = 'GET';
    public const HTTP_POST = 'POST';
    public const HTTP_METHODS = [self::HTTP_DELETE, self::HTTP_GET, self::HTTP_POST];
    public const BASE_URI = 'https://gateway.sms77.io/api';

    /* @var string $apiKey */
    protected $apiKey;
    /* @var string $sentWith */
    protected $sentWith;

    /**
     * @param string $apiKey
     * @param string $sentWith
     * @throws Exception
     */
    public function __construct(string $apiKey, string $sentWith = 'php-api') {
        $this->apiKey = $apiKey;
        $this->sentWith = $sentWith;

        if ('' === $apiKey || !is_string($apiKey)) {
            throw new InvalidArgumentException(
                "Invalid required constructor argument apiKey: $apiKey");
        }

        if ('' === $sentWith || !is_string($sentWith)) {
            throw new InvalidArgumentException(
                "Invalid required constructor argument sentWith: $sentWith");
        }
    }

    public function getApiKey(): string {
        return $this->apiKey;
    }

    public function getSentWith(): string {
        return $this->sentWith;
    }

    /**
     * @param string $path
     * @param array $options
     * @return mixed
     */
    protected function delete(string $path, array $options = []) {
        return $this->request($path, self::HTTP_DELETE, $options);
    }

    /**
     * @param string $path
     * @param array $options
     * @param string $method
     * @return mixed
     */
    private function request(string $path, string $method, array $options = []) {
        $method = strtoupper($method);
        if (!in_array($method, self::HTTP_METHODS)) {
            $methods = implode(',', self::HTTP_METHODS);

            throw new InvalidArgumentException(
                "Invalid method '$method' - valid methods are $methods");
        }

        $headers = [
            "X-Api-Key: $this->apiKey",
            "sentWith: $this->sentWith",
        ];
        $url = self::BASE_URI . "/$path";
        $params = http_build_query($options);
        if (self::HTTP_GET === $method) $url .= "?$params";

        $ch = curl_init($url);

        if (self::HTTP_POST === $method) {
            if ($path === 'sms') {
                $headers[] = 'Content-Type: application/json';
                $params = stripslashes(json_encode($options));
            }

            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_POST, true);
        }

        if (self::HTTP_DELETE === $method) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, self::HTTP_DELETE);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $res = curl_exec($ch);

        curl_close($ch);

        if (false === $res) {
            throw new UnexpectedValueException(curl_error($ch));
        }

        try {
            $res = json_decode($res, false, 512, JSON_THROW_ON_ERROR);
        } catch (Exception $e) {
        }

        return $res;
    }

    /**
     * @param string $path
     * @param array $options
     * @return mixed
     */
    protected function post(string $path, array $options = []) {
        return $this->request($path, self::HTTP_POST, $options);
    }

    /**
     * @param string $path
     * @param array $options
     * @return mixed
     */
    protected function get(string $path, array $options = []) {
        return $this->request($path, self::HTTP_GET, $options);
    }
}
