<?php declare(strict_types=1);

namespace Seven\Api\Resource\Balance;

use Seven\Api\Resource\Resource;

class BalanceResource extends Resource {
    public function get(): Balance {
        $res = $this->client->get('balance');
        return new Balance($res);
    }
}
