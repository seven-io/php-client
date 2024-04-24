<?php declare(strict_types=1);

namespace Seven\Api;

use Exception;
use InvalidArgumentException;
use Seven\Api\Constant\HttpMethod;
use UnexpectedValueException;

abstract class BaseClient
{
    public const BASE_URI = 'https://gateway.seven.io/api';
    /**
     * @var array|string[]
     */
    protected array $headers;

    /**
     * @throws Exception
     */
    public function __construct(
        protected string $apiKey,
        protected string $sentWith = 'php-api'
    )
    {
        if ('' === $apiKey) throw new InvalidArgumentException(
            'Invalid required constructor argument apiKey: ' . $apiKey);

        if ('' === $sentWith || !is_string($sentWith)) throw new InvalidArgumentException(
            'Invalid required constructor argument sentWith: ' . $sentWith);

        $this->headers = [
            'Accept: application/json',
            'SentWith: ' . $this->sentWith,
            'X-Api-Key:' . $this->apiKey,
        ];
        //$this->setContentTypeJson();
    }

    public function setContentTypeJson(): void
    {
        $this->setContentType('application/json');
    }

    public function setContentType(string $contentType): void
    {
        $this->headers['Content-Type'] = $contentType;
    }

    public function setContentTypeUrlEncoded(): void
    {
        $this->setContentType('application/x-www-form-urlencoded');
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
        $headers = array_unique([...$this->headers, ...$headers]);
        $url = self::BASE_URI . '/' . $path;
        $params = http_build_query($payload);
        if (HttpMethod::GET === $method) $url .= str_ends_with($url, '?') ? '' : '?' . $params;

        $ch = curl_init($url);

        if (HttpMethod::POST === $method) {
            $value = $headers['Content-Type'] ?? '' === 'application/json'
                ? json_encode($payload, JSON_UNESCAPED_UNICODE)
                : $params;
            curl_setopt($ch, CURLOPT_POSTFIELDS, $value);
            curl_setopt($ch, CURLOPT_POST, true);
        } elseif (HttpMethod::PATCH === $method) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, HttpMethod::PATCH->name);
        } elseif (HttpMethod::DELETE === $method) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, HttpMethod::DELETE->name);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

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
