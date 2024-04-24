<?php

namespace Seven\Api\Resource;

use Seven\Api\Constant\HooksAction;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Params\Hooks\SubscribeParams;
use Seven\Api\Params\HooksParams;
use Seven\Api\Response\Hooks\Hooks;
use Seven\Api\Response\Hooks\HookSubscribe;
use Seven\Api\Response\Hooks\HookUnsubscribe;
use Seven\Api\Validator\HooksValidator;

class HooksResource extends Resource
{
    /**
     * @throws InvalidRequiredArgumentException
     */
    public function unsubscribe(int $id): HookUnsubscribe
    {
        $params = (new HooksParams(HooksAction::UNSUBSCRIBE))->setId($id);
        $this->validate($params);
        $obj = $this->client->post('hooks', $params->toArray());;
        return new HookUnsubscribe($obj);
    }

    /**
     * @param HooksParams $params
     * @throws InvalidRequiredArgumentException
     */
    public function validate($params): void
    {
        (new HooksValidator($params))->validate();
    }

    public function subscribe(SubscribeParams $params): HookSubscribe
    {
        return new HookSubscribe($this->client->post('hooks', $params->toArray()));
    }

    /** @throws InvalidRequiredArgumentException */
    public function read(): Hooks
    {
        $params = new HooksParams(HooksAction::READ);
        $this->validate($params);
        $obj = $this->client->get('hooks', $params->toArray());
        return new Hooks($obj);
    }
}
