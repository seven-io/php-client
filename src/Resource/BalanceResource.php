<?php

namespace Seven\Api\Resource;

use Seven\Api\Response\Balance;

class BalanceResource extends Resource {
    public function validate($params): void {
    }

    public function get(): Balance {
        $res = $this->client->get('balance');
        return new Balance($res);
    }
}
