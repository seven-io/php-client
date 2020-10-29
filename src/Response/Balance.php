<?php declare(strict_types=1);

namespace Sms77\Api\Response;

/** @property float balance */
class Balance {
    public function __construct(float $response) {
        $this->balance = $response;
    }
}