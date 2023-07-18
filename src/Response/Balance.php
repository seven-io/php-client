<?php declare(strict_types=1);

namespace Seven\Api\Response;

/** @property float balance */
class Balance {
    public function __construct(float $response) {
        $this->balance = $response;
    }
}
