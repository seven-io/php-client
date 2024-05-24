<?php declare(strict_types=1);

namespace Seven\Api\Resource\Hooks;

use Random\RandomException;
use Seven\Api\Exception\ForbiddenIpException;
use Seven\Api\Exception\InvalidApiKeyException;
use Seven\Api\Exception\MissingAccessRightsException;
use Seven\Api\Exception\SigningHashVerificationException;
use Seven\Api\Exception\UnexpectedApiResponseException;
use Seven\Api\Params\Hooks\SubscribeParams;
use Seven\Api\Resource\Resource;
use Seven\Api\Response\Hooks\Hooks;
use Seven\Api\Response\Hooks\HookSubscribe;
use Seven\Api\Response\Hooks\HookUnsubscribe;

class HooksResource extends Resource {
    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     * @throws RandomException
     * @throws MissingAccessRightsException
     * @throws InvalidApiKeyException
     */
    public function unsubscribe(int $id): HookUnsubscribe {
        return new HookUnsubscribe($this->client->delete('hooks?id=' . $id));
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     * @throws RandomException
     * @throws MissingAccessRightsException
     * @throws InvalidApiKeyException
     */
    public function subscribe(SubscribeParams $params): HookSubscribe {
        return new HookSubscribe($this->client->post('hooks', $params->toArray()));
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws RandomException
     * @throws UnexpectedApiResponseException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     */
    public function read(): Hooks {
        return new Hooks($this->client->get('hooks'));
    }
}
