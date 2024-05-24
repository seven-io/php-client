<?php declare(strict_types=1);

namespace Seven\Api\Resource\Subaccounts;

use Random\RandomException;
use Seven\Api\Exception\ForbiddenIpException;
use Seven\Api\Exception\InvalidApiKeyException;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Exception\MissingAccessRightsException;
use Seven\Api\Exception\SigningHashVerificationException;
use Seven\Api\Exception\UnexpectedApiResponseException;
use Seven\Api\Resource\Resource;

class SubaccountsResource extends Resource {
    /**
     * @throws ForbiddenIpException
     * @throws InvalidApiKeyException
     * @throws InvalidRequiredArgumentException
     * @throws MissingAccessRightsException
     * @throws RandomException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     */
    public function delete(int $id): SubaccountDelete {
        if ($id < 1) throw new InvalidRequiredArgumentException('Argument \'id\' must be > 0.');

        return new SubaccountDelete($this->client->post('subaccounts', ['id' => $id, 'action' => 'delete']));
    }

    /**
     * @return Subaccount[]
     * @throws InvalidRequiredArgumentException
     * @throws RandomException
     * @throws ForbiddenIpException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     */
    public function read(int $id = null): array {
        if ($id !== null && $id < 1) throw new InvalidRequiredArgumentException('Argument \'id\' must be > 0.');
        $arr = $this->client->get('subaccounts', ['action' => 'read', 'id' => $id]);
        return array_map(static fn(object $obj) => new Subaccount($obj), $arr);
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws RandomException
     * @throws UnexpectedApiResponseException
     * @throws MissingAccessRightsException
     * @throws InvalidApiKeyException
     */
    public function create(CreateParams $params): SubaccountCreate {
        return new SubaccountCreate($this->client->post('subaccounts', [...$params->toArray(), 'action' => 'create']));
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws RandomException
     * @throws UnexpectedApiResponseException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     */
    public function transferCredits(TransferCreditsParams $params): SubaccountTransferCredits {
        $res = $this->client->post('subaccounts', [...$params->toArray(), 'action' => 'transfer_credits']);
        return new SubaccountTransferCredits($res);
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws RandomException
     * @throws UnexpectedApiResponseException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     */
    public function autoCharge(AutoChargeParams $params): SubaccountAutoCharged {
        $res = $this->client->post('subaccounts', [...$params->toArray(), 'action' => 'update']);
        return new SubaccountAutoCharged($res);
    }
}
