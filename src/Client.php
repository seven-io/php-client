<?php declare(strict_types=1);

namespace Seven\Api;

use Exception;
use InvalidArgumentException;
use Random\RandomException;
use Seven\Api\Exception\ForbiddenIpException;
use Seven\Api\Exception\InvalidApiKeyException;
use Seven\Api\Exception\MissingAccessRightsException;
use Seven\Api\Exception\SigningHashVerificationException;
use Seven\Api\Exception\UnexpectedApiResponseException;
use Seven\Api\Library\HttpMethod;
use stdClass;

class Client {
    public const BASE_URI = 'https://gateway.seven.io/api';
    private const SENT_WITH = 'php-api';
    /** @var string[] $headers */
    protected array $headers = [
        'Accept: application/json',
    ];
    protected string $sentWith;

    /**
     * @throws InvalidArgumentException
     * @param string $apiKey The API key for authentication
     * @param string|null $sentWith @deprecated This parameter is deprecated and will be removed in a future version. The value is always 'php-api'.
     * @param string|null $signingSecret The signing secret for request verification
     */
    public function __construct(
        protected string  $apiKey,
        ?string  $sentWith = 'php-api',
        protected ?string $signingSecret = null,
    ) {
        if (!$this->apiKey) throw new InvalidArgumentException('apiKey can not be empty');
        
        // Always use the class constant, ignore the parameter
        $this->sentWith = self::SENT_WITH;
        
        $this->headers[] = 'SentWith: ' . $this->sentWith;
        $this->setApiKey($this->apiKey);
    }

    public function getApiKey(): string {
        return $this->apiKey;
    }

    public function getSentWith(): string {
        return $this->sentWith;
    }

    public function setApiKey(string $apiKey): self {
        $this->apiKey = $apiKey;
        $this->headers[] = 'X-Api-Key: ' . $this->apiKey;
        return $this;
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws RandomException
     * @throws UnexpectedApiResponseException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     */
    public function delete(string $path, array $options = []): mixed {
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
    protected function request(string $path, HttpMethod $method, array $payload = []): mixed {
        $url = self::BASE_URI . '/' . $path;
        $params = http_build_query($payload);
        if (HttpMethod::GET === $method) {
            if ($params !== '') {
                $url .= (str_contains($url, '?') ? '&' : '?') . $params;
            }
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
            $toHash = HttpMethod::GET->name === $method->name ? '' : $params;
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
        $isSuccess = $httpCode === 200;
        $error = curl_error($ch);

        if ($error !== '') throw new UnexpectedApiResponseException($error);
        if (false === $res) throw new UnexpectedApiResponseException($error);
        if (in_array($res, ['"900"', '"901"', '"902"', '"903"', '"600"'], true)) {
            throw match ($res) {
                '"900"' => new InvalidApiKeyException,
                '"901"' => new SigningHashVerificationException,
                '"902"' => new MissingAccessRightsException,
                '"903"' => new ForbiddenIpException,
                '"600"' => new UnexpectedApiResponseException('An error has occurred'),
            };
        }

        try {
            $res = json_decode($res, false, 512, JSON_THROW_ON_ERROR);
        } catch (Exception) {
        }

        // Check for error codes even on HTTP 200 responses
        if (is_int($res) || (is_object($res) && property_exists($res, 'code')) || (is_object($res) && property_exists($res, 'error_code'))) {
            $sourceObject = is_object($res) ? $res : new stdClass;
            $code = property_exists($sourceObject, 'code')
                ? $res->code
                : (property_exists($sourceObject, 'error_code')
                    ? $res->error_code
                    : (int)$res);
            
            if (in_array($code, [900, 901, 902, 903])) {
                throw match ($code) {
                    900 => new InvalidApiKeyException,
                    901 => new SigningHashVerificationException,
                    902 => new MissingAccessRightsException,
                    903 => new ForbiddenIpException,
                };
            }
        }

        if ($isSuccess) return $res;

        $errorMessage = sprintf('Unexpected API response: HTTP %d', $httpCode);
        if (is_string($res) && !empty($res)) {
            $errorMessage .= ' - Response: ' . substr($res, 0, 500);
        }
        throw new UnexpectedApiResponseException($errorMessage);
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     * @throws RandomException
     * @throws MissingAccessRightsException
     * @throws InvalidApiKeyException
     */
    public function patch(string $path, array $payload = []): mixed {
        return $this->request($path, HttpMethod::PATCH, $payload);
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     * @throws RandomException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     */
    public function post(string $path, array $payload = []): mixed {
        return $this->request($path, HttpMethod::POST, $payload);
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     * @throws RandomException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     */
    public function get(string $path, array $params = []): mixed {
        return $this->request($path, HttpMethod::GET, $params);
    }
}