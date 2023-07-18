<?php declare(strict_types=1);

namespace Seven\Api\Response;

/** @property int code */
class ContactDelete {
    public function __construct(int $response) {
        $this->code = $response;
    }
}
