<?php declare(strict_types=1);

namespace Sms77\Tests\Client;

use DateTime;
use Sms77\Api\Constant\StatusMessage;
use Sms77\Api\Response\Status;

class StatusTest extends BaseTest {
    public function testStatus(): void {
        $status = new Status($this->status(false));

        self::assertContains($status->status, StatusMessage::values());

        self::assertInstanceOf('DateTime', new DateTime($status->dateTime));
    }

    private function status(bool $json) {
        return $this->client->status((int)getenv('SMS77_MSG_ID'), $json);
    }

    public function testStatusJson(): void {
        $status = $this->status(true);

        self::assertContains($status->status, StatusMessage::values());

        self::assertInstanceOf('DateTime', new DateTime($status->dateTime));
    }
}