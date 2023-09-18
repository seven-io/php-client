<?php

namespace Seven\Api\Resource;

use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Exception\UnexpectedApiResponseException;
use Seven\Api\Params\StatusParams;
use Seven\Api\Response\Status;
use Seven\Api\Validator\StatusValidator;

class StatusResource extends Resource {
    /**
     * @return Status[]
     * @throws InvalidRequiredArgumentException
     * @throws UnexpectedApiResponseException
     */
    public function get(int ...$msgIds): array {
        $params = new StatusParams(...$msgIds);
        $this->validate($params);

        $res = $this->client->get('status', array_merge($params->toArray(), ['json' => true]));

        if (!is_array($res)) throw new UnexpectedApiResponseException($res);

        return array_map(static function ($obj) {
            return new Status($obj);
        }, $res);
    }

    /**
     * @param StatusParams $params
     * @throws InvalidRequiredArgumentException
     */
    public function validate($params): void {
        (new StatusValidator($params))->validate();
    }
}
