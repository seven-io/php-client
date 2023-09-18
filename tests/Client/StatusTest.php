<?php declare(strict_types=1);

namespace Seven\Tests\Client;

use Seven\Api\Constant\StatusMessage;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Params\JournalParams;

class StatusTest extends BaseTest {
    public function testError(): void {
        $this->expectException(InvalidRequiredArgumentException::class);
        $this->client->status->get(0);
    }

    public function testSuccess(): void {
        $msgId = $this->getMessageId();
        $arr = $this->client->status->get($msgId);

        foreach ($arr as $obj) {
            $status = $obj->getStatus();
            $statusTime = $obj->getStatusTime();

            if ($status) {
                $this->assertContains($status, StatusMessage::values());
                $this->assertNotNull($statusTime);
            } else $this->assertNull($statusTime);
        }
    }

    private function getMessageId(): int {
        $journalParams = (new JournalParams)->setLimit(1);
        $outbounds = $this->client->journal->outbound($journalParams);
        $outbound = $outbounds[0];
        $msgId = $outbound->getId();
        return (int)$msgId;
    }
}
