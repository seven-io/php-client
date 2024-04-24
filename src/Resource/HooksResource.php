<?php declare(strict_types=1);

namespace Seven\Api\Resource;

use Seven\Api\Params\Hooks\SubscribeParams;
use Seven\Api\Response\Hooks\Hooks;
use Seven\Api\Response\Hooks\HookSubscribe;
use Seven\Api\Response\Hooks\HookUnsubscribe;

class HooksResource extends Resource
{
    public function unsubscribe(int $id): HookUnsubscribe
    {
        return new HookUnsubscribe($this->client->delete('hooks?id=' . $id));
    }

    public function validate($params): void
    {
        // TODO?
    }

    public function subscribe(SubscribeParams $params): HookSubscribe
    {
        return new HookSubscribe($this->client->post('hooks', $params->toArray()));
    }

    public function read(): Hooks
    {
        return new Hooks($this->client->get('hooks'));
    }
}
