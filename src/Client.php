<?php declare(strict_types=1);

namespace Seven\Api;

use Exception;
use InvalidArgumentException;
use Seven\Api\Constant\HttpMethod;
use UnexpectedValueException;

class Client
{
    public const BASE_URI = 'https://gateway.seven.io/api';
    /** @var string[] $headers */
    protected array $headers;

    /**
     * @throws Exception
     */
    public function __construct(
        protected string  $apiKey,
        protected string  $sentWith = 'php-api',
        protected ?string $signingSecret = null,
    )
    {
        if ('' === $apiKey) throw new InvalidArgumentException(
            'Invalid required constructor argument apiKey: ' . $apiKey);

        if ('' === $sentWith) throw new InvalidArgumentException(
            'Invalid required constructor argument sentWith: ' . $sentWith);

        $this->headers = [
            'Accept: application/json',
            'SentWith: ' . $this->sentWith,
            'X-Api-Key: ' . $this->apiKey,
        ];
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getSentWith(): string
    {
        return $this->sentWith;
    }

    public function delete(string $path, array $options = [], array $headers = []): mixed
    {
        return $this->request($path, HttpMethod::DELETE, $options, $headers);
    }

    protected function request(string $path, HttpMethod $method, array $payload = [], array $headers = []): mixed
    {
        $url = self::BASE_URI . '/' . $path;
        $params = http_build_query($payload);
        if (HttpMethod::GET === $method) $url .= str_ends_with($url, '?') ? '' : '?' . $params;

        $ch = curl_init($url);

        if (HttpMethod::POST === $method) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_POST, true);
        } elseif (HttpMethod::PATCH === $method) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, HttpMethod::PATCH->name);
        } elseif (HttpMethod::DELETE === $method) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, HttpMethod::DELETE->name);
        }

        if ($this->signingSecret) {
            $nonce = bin2hex(random_bytes(16));
            $timestamp = time();
            $toSign = $timestamp . PHP_EOL .
                $nonce . PHP_EOL .
                $method->name . PHP_EOL .
                $url . PHP_EOL .
                md5($params);
            $hash = hash_hmac('sha256', $toSign, $this->signingSecret);
            $this->headers[] = 'X-Nonce: ' . $nonce;
            $this->headers[] = 'X-Signature: ' . $hash;
            $this->headers[] = 'X-Timestamp: ' . $timestamp;
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array_unique([...$this->headers, ...$headers]));

        $res = curl_exec($ch);

        if (false === $res) throw new UnexpectedValueException(curl_error($ch));

        curl_close($ch);

        try {
            $res = json_decode($res, false, 512, JSON_THROW_ON_ERROR);
        } catch (Exception) {
        }

        return $res;
    }

    public function patch(string $path, array $payload = [], array $headers = []): mixed
    {
        return $this->request($path, HttpMethod::PATCH, $payload, $headers);
    }

    public function post(string $path, array $payload = [], array $headers = []): mixed
    {
        return $this->request($path, HttpMethod::POST, $payload, $headers);
    }

    public function get(string $path, array $params = [], array $headers = []): mixed
    {
        return $this->request($path, HttpMethod::GET, $params, $headers);
    }
}
