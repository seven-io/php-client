<?php declare(strict_types=1);

namespace Seven\Api\Resource\Lookup;

use Random\RandomException;
use Seven\Api\Exception\ForbiddenIpException;
use Seven\Api\Exception\InvalidApiKeyException;
use Seven\Api\Exception\MissingAccessRightsException;
use Seven\Api\Exception\SigningHashVerificationException;
use Seven\Api\Exception\UnexpectedApiResponseException;
use Seven\Api\Resource\Resource;

class LookupResource extends Resource {
    /**
     * @return LookupFormat[]
     * @throws ForbiddenIpException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     * @throws RandomException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     */
    public function format(string ...$numbers): array {
        $res = $this->fetch('format', ...$numbers);
        return array_map(static fn($obj) => new LookupFormat($obj), is_array($res) ? $res : [$res]);
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws RandomException
     * @throws UnexpectedApiResponseException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     */
    protected function fetch(string $type, string ...$numbers): object|array {
        return $this->client->get('lookup/' . $type, ['number' => implode(',', $numbers)]);
    }

    /**
     * @return LookupCnam[]
     * @throws ForbiddenIpException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     * @throws RandomException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     */
    public function cnam(string ...$numbers): array {
        $res = $this->fetch('cnam', ...$numbers);
        return array_map(static fn($obj) => new LookupCnam($obj), is_array($res) ? $res : [$res]);
    }

    /**
     * @return LookupHlr[]
     * @throws ForbiddenIpException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     * @throws RandomException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     */
    public function hlr(string ...$numbers): array {
        $res = $this->fetch('hlr', ...$numbers);
        return array_map(static fn($obj) => new LookupHlr($obj), is_array($res) ? $res : [$res]);
    }

    /**
     * @return LookupMnp[]
     * @throws ForbiddenIpException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     * @throws RandomException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     */
    public function mnp(string ...$numbers): array {
        $res = $this->fetch('mnp', ...$numbers);
        return array_map(static fn($obj) => new LookupMnp($obj), is_array($res) ? $res : [$res]);
    }

    /**
     * @return LookupRcsCapabilities[]
     * @throws ForbiddenIpException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     * @throws RandomException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     */
    public function rcsCapabilities(string ...$numbers): array {
        $res = $this->fetch('rcs', ...$numbers);
        return array_map(static fn($obj) => new LookupRcsCapabilities($obj), is_array($res) ? $res : [$res]);
    }
}
