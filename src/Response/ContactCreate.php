<?php declare(strict_types=1);

namespace Sms77\Api\Response;

/**
 * @property int code
 * @property int id
 */
class ContactCreate {
    public function __construct(string $response) {
        [$code, $id] = explode(PHP_EOL, $response);

        $this->code = (int)$code;
        $this->id = (int)$id;
    }
}