<?php

namespace Seven\Api\Resource;

use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Params\Rcs\RcsEventParams;
use Seven\Api\Params\Rcs\RcsParams;
use Seven\Api\Response\Rcs\Rcs;
use Seven\Api\Response\Rcs\RcsDeleted;
use Seven\Api\Response\Rcs\RcsEventDispatched;
use Seven\Api\Validator\RcsValidator;

class RcsResource extends Resource
{
    public function delete(int $id): RcsDeleted
    {
        $res = $this->client->delete('rcs/messages/' . $id);

        return new RcsDeleted($res);
    }

    /**
     * @throws InvalidRequiredArgumentException
     * @throws InvalidOptionalArgumentException
     */
    public function dispatch(RcsParams $params): Rcs
    {
        $this->validate($params);

        $res = $this->client->post('rcs/messages', $params->toArray());
        var_dump($res);

        return new Rcs($res);
    }

    /**
     * @param RcsParams $params
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function validate($params): void
    {
        (new RcsValidator($params))->validate();
    }

    public function event(RcsEventParams $params): RcsEventDispatched
    {
        $res = $this->client->post('rcs/events', $params->toArray());

        return new RcsEventDispatched($res);
    }
}
