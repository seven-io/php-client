<?php declare(strict_types=1);

namespace Seven\Api\Resource;

use Seven\Api\Constant\SubaccountsAction;
use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Params\Subaccounts\CreateSubaccountParams;
use Seven\Api\Params\Subaccounts\SubaccountsParams;
use Seven\Api\Response\Subaccounts\Subaccount;
use Seven\Api\Response\Subaccounts\SubaccountCreate;
use Seven\Api\Response\Subaccounts\SubaccountDelete;
use Seven\Api\Response\Subaccounts\SubaccountTransferCredits;
use Seven\Api\Response\Subaccounts\SubaccountUpdate;
use Seven\Api\Validator\SubaccountsValidator;

class SubaccountsResource extends Resource
{
    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function delete(int $id): SubaccountDelete
    {
        $params = (new SubaccountsParams(SubaccountsAction::DELETE))->setId($id);
        $res = $this->fetch($params, 'POST');

        return new SubaccountDelete($res);
    }

    /**
     * @return mixed
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    protected function fetch(SubaccountsParams $params, string $method)
    {
        $this->validate($params);

        return $this->client->$method('subaccounts', $params->toArray());
    }

    /**
     * @param SubaccountsParams $params
     * @throws InvalidRequiredArgumentException
     */
    public function validate($params): void
    {
        (new SubaccountsValidator($params))->validate();
    }

    /**
     * @return Subaccount[]
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function read(): array
    {
        $params = new SubaccountsParams(SubaccountsAction::READ);
        $arr = $this->fetch($params, 'GET');

        return array_map(static function (object $value) {
            return new Subaccount($value);
        }, $arr);
    }

    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function create(CreateSubaccountParams $params): SubaccountCreate
    {
        $res = $this->fetch($params, 'POST');

        return new SubaccountCreate($res);
    }

    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function transferCredits(int $id, float $amount): SubaccountTransferCredits
    {
        $params = (new SubaccountsParams(SubaccountsAction::TRANSFER_CREDITS))
            ->setAmount($amount)
            ->setId($id);
        $res = $this->fetch($params, 'POST');

        return new SubaccountTransferCredits($res);
    }

    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function update(int $id, float $amount, float $threshold): SubaccountUpdate
    {
        $params = (new SubaccountsParams(SubaccountsAction::UPDATE))
            ->setAmount($amount)
            ->setId($id)
            ->setThreshold($threshold);
        $res = $this->fetch($params, 'POST');

        return new SubaccountUpdate($res);
    }
}
