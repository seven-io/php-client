<?php declare(strict_types=1);

namespace Seven\Tests\Client;

use DateInterval;
use DateTime;
use Seven\Api\Constant\SmsConstants;
use Seven\Api\Params\JournalParams;
use Seven\Api\Response\Journal\JournalInbound;
use Seven\Api\Response\Journal\JournalOutbound;
use Seven\Api\Response\Journal\JournalReply;
use Seven\Api\Response\Journal\JournalVoice;

class JournalTest extends BaseTest {
    public function testJournalInbound(): void {
        $arr = $this->client->journal->inbound();
        $this->request($arr, JournalInbound::class);
    }

    private function request(
        array     $journals,
        string    $class,
        ?callable $functionHandler = null
    ): void {
        $this->assertIsArray($journals);

        foreach ($journals as $j) {
            $this->assertInstanceOf($class, $j);
            $this->assertIsString($j->getFrom());
            $this->assertIsNumeric($j->getId());
            $this->assertTrue(property_exists($j, 'price'));
            $this->assertIsLengthyString($j->getText());
            $this->assertIsValidDateTime($j->getTimestamp());
            $this->assertIsLengthyString($j->getTo());

            if ($functionHandler) $functionHandler($j);
        }
    }

    public function testJournalOutbound(): void {
        $arr = $this->client->journal->outbound();
        $callable = function (JournalOutbound $j) {
            $this->assertIsString($j->getConnection());
            $this->assertIsNullOrLengthyString($j->getDlr());
            $this->assertIsNullOrLengthyString($j->getDlrTimestamp());
            $this->assertIsNullOrLengthyString($j->getForeignId());
            $this->assertIsNullOrLengthyString($j->getLabel());
            $this->assertIsNullOrLengthyString($j->getLatency());
            $this->assertIsNullOrLengthyString($j->getMccMnc());
            $this->assertEquals(SmsConstants::TYPE_DIRECT, $j->getType());
        };

        $this->request($arr, JournalOutbound::class, $callable);
    }

    public function testJournalVoice(): void {
        $arr = $this->client->journal->voice();
        $callable = function (JournalVoice $j) {
            $this->assertIsNullOrLengthyString($j->getDuration());
            $this->assertIsNullOrString($j->getError());
            $this->assertIsString($j->getStatus());
            $this->assertIsBool($j->isXml());
        };

        $this->request($arr, JournalVoice::class, $callable);
    }

    public function testJournalReplies(): void {
        $arr = $this->client->journal->replies();

        $this->request($arr, JournalReply::class);
    }

    public function testJournalParams(): void {
        $params = (new JournalParams)
            ->setId(null)
            ->setDateFrom((new DateTime)->sub(DateInterval::createFromDateString('30 day')))
            ->setDateTo(new DateTime)
            ->setLimit(null)
            ->setState('')
            ->setTo('')
            ->toArray();

        $this->assertArrayHasKey('date_from', $params);
        $this->assertArrayHasKey('date_to', $params);
    }
}
