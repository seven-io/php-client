<?php

namespace Seven\Api\Resource;

use Seven\Api\Params\Numbers\ListAvailableParams;
use Seven\Api\Params\Numbers\OrderParams;
use Seven\Api\Params\Numbers\UpdateParams;
use Seven\Api\Response\Numbers\ActiveNumbers;
use Seven\Api\Response\Numbers\AvailableNumbers;
use Seven\Api\Response\Numbers\NumberDeletion;
use Seven\Api\Response\Numbers\NumberOrder;
use Seven\Api\Response\Numbers\PhoneNumber;

class NumbersResource extends Resource
{
    public function delete(string $number, bool $deleteImmediately = false): NumberDeletion
    {
        $path = 'numbers/active/' . $number;
        if ($deleteImmediately) $path .= '?delete_immediately=true';

        return new NumberDeletion($this->client->delete($path));
    }

    public function order(OrderParams $params): NumberOrder
    {
        return new NumberOrder($this->client->post('numbers/order', $params->toArray()));
    }

    public function update(UpdateParams $params): PhoneNumber
    {
        return new PhoneNumber($this->client->patch('numbers/active/' . $params->getNumber(), $params->toArray()));
    }

    public function validate($params): void
    {
        // TODO?
    }

    public function listActive(): ActiveNumbers
    {
        return new ActiveNumbers($this->client->get('numbers/active'));
    }

    public function get(string $number): PhoneNumber
    {
        return new PhoneNumber($this->client->get('numbers/active/' . $number));
    }

    public function listAvailable(ListAvailableParams $params = new ListAvailableParams): AvailableNumbers
    {
        return new AvailableNumbers($this->client->get('numbers/available', $params->toArray()));
    }
}
