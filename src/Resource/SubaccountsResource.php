<?php declare(strict_types=1);

namespace Seven\Api\Resource;

use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Params\Subaccounts\AutoChargeParams;
use Seven\Api\Params\Subaccounts\CreateParams;
use Seven\Api\Params\Subaccounts\TransferCreditsParams;
use Seven\Api\Response\Subaccounts\Subaccount;
use Seven\Api\Response\Subaccounts\SubaccountAutoCharged;
use Seven\Api\Response\Subaccounts\SubaccountCreate;
use Seven\Api\Response\Subaccounts\SubaccountDelete;
use Seven\Api\Response\Subaccounts\SubaccountTransferCredits;

class SubaccountsResource extends Resource
{
    /**
     * @throws InvalidRequiredArgumentException
     */
    public function delete(int $id): SubaccountDelete
    {
        if ($id < 1) throw new InvalidRequiredArgumentException('Argument \'id\' must be > 0.');

        return new SubaccountDelete($this->client->post('subaccounts', ['id' => $id, 'action' => 'delete']));
    }

    /**
     * @return Subaccount[]
     * @throws InvalidRequiredArgumentException
     */
    public function read(int $id = null): array
    {
        if ($id !== null && $id < 1) throw new InvalidRequiredArgumentException('Argument \'id\' must be > 0.');
        $arr = $this->client->get('subaccounts', ['action' => 'read', 'id' => $id]);
        return array_map(static fn(object $obj) => new Subaccount($obj), $arr);
    }

    public function create(CreateParams $params): SubaccountCreate
    {
        return new SubaccountCreate($this->client->post('subaccounts', [...$params->toArray(), 'action' => 'create']));
    }

    public function transferCredits(TransferCreditsParams $params): SubaccountTransferCredits
    {
        $res = $this->client->post('subaccounts', [...$params->toArray(), 'action' => 'transfer_credits']);
        return new SubaccountTransferCredits($res);
    }

    public function autoCharge(AutoChargeParams $params): SubaccountAutoCharged
    {
        $res = $this->client->post('subaccounts', [...$params->toArray(), 'action' => 'update']);
        return new SubaccountAutoCharged($res);
    }

    public function validate($params): void
    {
        // TODO?
    }
}
