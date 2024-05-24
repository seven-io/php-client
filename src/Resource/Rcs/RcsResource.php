<?php declare(strict_types=1);

namespace Seven\Api\Resource\Rcs;

use Random\RandomException;
use Seven\Api\Exception\ForbiddenIpException;
use Seven\Api\Exception\InvalidApiKeyException;
use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Exception\MissingAccessRightsException;
use Seven\Api\Exception\SigningHashVerificationException;
use Seven\Api\Exception\UnexpectedApiResponseException;
use Seven\Api\Resource\Resource;

class RcsResource extends Resource {
    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     * @throws RandomException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     */
    public function delete(int $id): RcsDeleted {
        $res = $this->client->delete('rcs/messages/' . $id);

        return new RcsDeleted($res);
    }

    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     * @throws RandomException
     * @throws ForbiddenIpException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     */
    public function dispatch(RcsParams $params): Rcs {
        $this->validate($params);

        $res = $this->client->post('rcs/messages', $params->toArray());
        var_dump($res);

        return new Rcs($res);
    }

    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function validate(RcsParams $params): void {
        (new RcsValidator($params))->validate();
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws RandomException
     * @throws UnexpectedApiResponseException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     */
    public function event(RcsEventParams $params): RcsEventDispatched {
        $res = $this->client->post('rcs/events', $params->toArray());

        return new RcsEventDispatched($res);
    }
}
