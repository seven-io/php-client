<?php declare(strict_types=1);

namespace Seven\Api;

use Exception;
use InvalidArgumentException;
use Random\RandomException;
use Seven\Api\Constant\HttpMethod;
use Seven\Api\Exception\ForbiddenIpException;
use Seven\Api\Exception\InvalidApiKeyException;
use Seven\Api\Exception\MissingAccessRightsException;
use Seven\Api\Exception\SigningHashVerificationException;
use Seven\Api\Exception\UnexpectedApiResponseException;

class Client
{
    public const BASE_URI = 'https://gateway.seven.io/api';
    /** @var string[] $headers */
    protected array $headers = [
        'Accept: application/json',
    ];

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(
        protected string  $apiKey,
        protected string  $sentWith = 'php-api',
        protected ?string $signingSecret = null,
    )
    {
        if (!$this->apiKey) throw new InvalidArgumentException('apiKey can not be empty');
        if (!$this->sentWith) throw new InvalidArgumentException('sentWith can not be empty');

        $this->headers[] = 'SentWith: ' . $this->sentWith;
        $this->headers[] = 'X-Api-Key: ' . $this->apiKey;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getSentWith(): string
    {
        return $this->sentWith;
    }

    public function delete(string $path, array $options = []): mixed
    {
        return $this->request($path, HttpMethod::DELETE, $options);
    }

    /**
     * @throws UnexpectedApiResponseException
     * @throws RandomException
     * @throws InvalidApiKeyException
     * @throws ForbiddenIpException
     * @throws MissingAccessRightsException
     * @throws SigningHashVerificationException
     */
    protected function request(string $path, HttpMethod $method, array $payload = []): mixed
    {
        $url = self::BASE_URI . '/' . $path;
        $params = http_build_query($payload);
        if (HttpMethod::GET === $method) {
            $url .= (str_ends_with($url, '?') ? '' : '?') . $params;
            $params = '';
        }

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

        $headers = $this->headers;

        if ($this->signingSecret) {
            $nonce = bin2hex(random_bytes(16));
            $timestamp = time();
            $toHash = HttpMethod::GET->name === $method->name ? '' : json_encode($params);
            $hashMd5 = md5($toHash);
            $toSign = [$timestamp, $nonce, $method->name, $url, $hashMd5];
            $toSign = implode(chr(10), $toSign);
            $signature = hash_hmac('sha256', $toSign, trim($this->signingSecret));
            $headers[] = 'X-Nonce: ' . $nonce;
            $headers[] = 'X-Signature: ' . $signature;
            $headers[] = 'X-Timestamp: ' . $timestamp;
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array_unique($headers));

        $res = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error !== '') throw new UnexpectedApiResponseException($error);
        if (false === $res) throw new UnexpectedApiResponseException($error);
        if ($httpCode !== 200) throw new UnexpectedApiResponseException($error);

        switch ($res) {
            case '900';
                throw new InvalidApiKeyException;
            case '901';
                throw new SigningHashVerificationException;
            case '902':
                throw new MissingAccessRightsException;
            case '903';
                throw new ForbiddenIpException;
            default:
                try {
                    $res = json_decode($res, false, 512, JSON_THROW_ON_ERROR);
                } catch (Exception) {
                }
        }

        return $res;
    }

    public function patch(string $path, array $payload = []): mixed
    {
        return $this->request($path, HttpMethod::PATCH, $payload);
    }

    public function post(string $path, array $payload = []): mixed
    {
        return $this->request($path, HttpMethod::POST, $payload);
    }

    public function get(string $path, array $params = []): mixed
    {
        return $this->request($path, HttpMethod::GET, $params);
    }
}
