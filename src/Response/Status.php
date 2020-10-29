<?php declare(strict_types=1);

namespace Sms77\Api\Response;

/**
 * @property string status
 * @property string dateTime
 */
class Status {
    public function __construct(string $response) {
        [$status, $dateTime] = explode(PHP_EOL, $response);

        $this->status = $status;
        $this->dateTime = $dateTime;
    }
}