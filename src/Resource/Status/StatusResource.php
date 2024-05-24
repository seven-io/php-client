<?php declare(strict_types=1);

namespace Seven\Api\Resource\Status;

use Random\RandomException;
use Seven\Api\Exception\ForbiddenIpException;
use Seven\Api\Exception\InvalidApiKeyException;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Exception\MissingAccessRightsException;
use Seven\Api\Exception\SigningHashVerificationException;
use Seven\Api\Exception\UnexpectedApiResponseException;
use Seven\Api\Params\StatusParams;
use Seven\Api\Resource\Resource;
use Seven\Api\Response\Status;
use Seven\Api\Validator\StatusValidator;

class StatusResource extends Resource {
    /**
     * @return Status[]
     * @throws InvalidRequiredArgumentException
     * @throws UnexpectedApiResponseException
     * @throws RandomException
     * @throws ForbiddenIpException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     * @throws SigningHashVerificationException
     */
    public function get(int ...$msgIds): array {
        $params = new StatusParams(...$msgIds);
        $this->validate($params);

        $res = $this->client->get('status', $params->toArray());

        if (!is_array($res)) throw new UnexpectedApiResponseException($res);

        return array_map(static fn($obj) => new Status($obj), $res);
    }

    /** @throws InvalidRequiredArgumentException */
    public function validate(StatusParams $params): void {
        (new StatusValidator($params))->validate();
    }
}
