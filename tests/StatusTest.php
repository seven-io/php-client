<?php declare(strict_types=1);

namespace Seven\Tests;

use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Resource\Journal\JournalParams;
use Seven\Api\Resource\Status\StatusMessage;

class StatusTest extends AbstractTestCase {
    public function testError(): void {
        $this->expectException(InvalidRequiredArgumentException::class);
        $this->resources->status->get(0);
    }

    public function testSuccess(): void {
        $msgId = $this->getMessageId();
        $arr = $this->resources->status->get($msgId, $msgId);
        $this->assertCount(2, $arr);

        foreach ($arr as $obj) {
            $status = $obj->getStatus();
            $statusTime = $obj->getStatusTime();

            if ($status) {
                $this->assertContains($status, array_column(StatusMessage::cases(), 'value'));
                $this->assertNotNull($statusTime);
            } else $this->assertNull($statusTime);
        }
    }

    private function getMessageId(): int {
        $journalParams = (new JournalParams)->setLimit(1);
        $outbounds = $this->resources->journal->outbound($journalParams);
        $outbound = $outbounds[0];
        $msgId = $outbound->getId();
        return (int)$msgId;
    }
}
