<?php declare(strict_types=1);

namespace Sms77\Api\Response;

/**
 * @property int code
 * @property int id
 * @property float price
 */
class Voice {
    public function __construct(string $response) {
        [$code, $id, $price] = explode(PHP_EOL, $response);

        $this->code = (int)$code;
        $this->id = (int)$id;
        $this->price = (float)$price;
    }
}