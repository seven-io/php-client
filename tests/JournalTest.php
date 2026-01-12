<?php declare(strict_types=1);

namespace Seven\Tests;

use DateInterval;
use DateTime;
use Seven\Api\Resource\Journal\JournalBase;
use Seven\Api\Resource\Journal\JournalOutbound;
use Seven\Api\Resource\Journal\JournalParams;
use Seven\Api\Resource\Journal\JournalVoice;
use Seven\Api\Resource\Sms\SmsConstants;

class JournalTest extends AbstractTestCase {
    public function testJournalInbound(): void {
        $arr = $this->resources->journal->inbound();
        $this->request($arr);
    }

    private function request(array $journals, ?callable $functionHandler = null): void {
        $this->assertIsArray($journals);

        /** @var JournalBase $j */
        foreach ($journals as $j) {
            $this->assertIsNumeric($j->getId());
            $this->assertGreaterThanOrEqual(0.0, $j->getPrice());
            $this->assertIsValidDateTime($j->getTimestamp());

            if ($functionHandler) $functionHandler($j);
        }
    }

    public function testJournalOutbound(): void {
        $arr = $this->resources->journal->outbound();
        $callable = function (JournalOutbound $j) {
            $this->assertIsNullOrLengthyString($j->getDlr());
            $this->assertIsNullOrLengthyString($j->getDlrTimestamp());
            $this->assertIsNullOrLengthyString($j->getForeignId());
            $this->assertIsNullOrLengthyString($j->getLabel());
            $this->assertIsNullOrLengthyString($j->getLatency());
            $this->assertIsNullOrLengthyString($j->getMccMnc());
            $this->assertEquals(SmsConstants::TYPE_DIRECT, $j->getType());
        };

        $this->request($arr, $callable);
    }

    public function testJournalVoice(): void {
        $arr = $this->resources->journal->voice();
        $callable = function (JournalVoice $j) {
            $this->assertIsNullOrLengthyString($j->getDuration());
            $this->assertIsNullOrString($j->getError());
            $this->assertIsBool($j->isXml());
        };

        $this->request($arr, $callable);
    }

    public function testJournalParams(): void {
        $params = (new JournalParams)
            ->setDateFrom((new DateTime)->sub(DateInterval::createFromDateString('30 day')))
            ->setDateTo(new DateTime)
            ->setId(null)
            ->setLimit(null)
            ->setState('')
            ->setTo('')
            ->toArray();

        $this->assertArrayHasKey('date_from', $params);
        $this->assertArrayNotHasKey('dateFrom', $params);
        $this->assertIsString($params['date_from']);

        $this->assertArrayHasKey('date_to', $params);
        $this->assertArrayNotHasKey('dateTo', $params);
        $this->assertIsString($params['date_to']);
    }
}
