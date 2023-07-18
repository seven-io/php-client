<?php declare(strict_types=1);

namespace Seven\Tests\Client;

use Seven\Api\Constant\JournalConstants;
use Seven\Api\Constant\SmsConstants;
use Seven\Api\Constant\SmsType;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Response\JournalBase;
use Seven\Api\Response\JournalInbound;
use Seven\Api\Response\JournalOutbound;
use Seven\Api\Response\JournalReplies;
use Seven\Api\Response\JournalVoice;

class JournalTest extends BaseTest {
    private function request(
        string $type,
        string $class,
        ?callable $functionHandler = null,
        array $options = []): void {
        $journals = $this->client->journal($type, $options);

        self::assertIsArray($journals);

        foreach ($journals as $j) {
            self::assertInstanceOf($class, $j);
            self::assertIsLengthyString($j->from);
            self::assertIsNumeric($j->id);
            self::assertIsNumeric($j->price);
            self::assertIsLengthyString($j->text);
            self::assertIsValidDateTime($j->timestamp);
            self::assertIsLengthyString($j->to);

            $functionHandler && $functionHandler($j);
        }
    }

    public function testJournalInbound(): void {
        $this->request(JournalConstants::TYPE_INBOUND, JournalInbound::class);
    }

    public function testJournalOutbound(): void {
        $this->request(
            JournalConstants::TYPE_OUTBOUND,
            JournalOutbound::class,
            static function (JournalOutbound $j) {
                self::assertIsString($j->connection);
                self::assertIsNullOrLengthyString($j->dlr);
                self::assertIsNullOrLengthyString($j->dlr_timestamp);
                self::assertIsNullOrLengthyString($j->foreign_id);
                self::assertIsNullOrLengthyString($j->label);
                self::assertIsNullOrLengthyString($j->latency);
                self::assertIsNullOrLengthyString($j->mccmnc);
                self::assertEquals(SmsConstants::TYPE_DIRECT, $j->type);
            });
    }

    public function testJournalVoice(): void {
        $this->request(
            JournalConstants::TYPE_VOICE,
            JournalVoice::class,
            static function (JournalVoice $j) {
                self::assertIsNumeric($j->duration);
                self::assertIsString($j->error);
                self::assertIsLengthyString($j->status);
                self::assertIsBool($j->xml);
            });
    }

    public function testJournalReplies(): void {
        $this->request(JournalConstants::TYPE_REPLIES, JournalReplies::class);
    }

    public function testJournalInvalidType(): void {
        $this->expectException(InvalidRequiredArgumentException::class);

        $this->request('INVALID_JOURNAL_TYPE', JournalBase::class);
    }
}
