<?php declare(strict_types=1);

namespace Sms77\Tests\Client;

use Sms77\Api\Response\Sms;

class SmsTest extends BaseTest {
    public function testSms(): void {
        self::assertIsInt($this->sms());
    }

    private function sms(array $options = []) {
        return $this->client->sms(
            $this->recipient, 'HI2U! The UNIX time is ' . time() . '.', $options);
    }

    public function testSmsDetails(): void {
        $res = $this->sms(['details' => true]);
        [$code, $booked, $price, $balance, $text,
            $type, $flash, $encoding, $gsm0338, $debug] = explode(PHP_EOL, $res);

        self::assertIsInt((int)$code);

        $booked = explode(':', $booked);
        $booked = (float)end($booked);
        self::assertIsFloat($booked);

        $price = explode(':', $price);
        $price = (float)end($price);
        self::assertIsFloat($price);

        $balance = explode(':', $balance);
        $balance = (float)end($balance);
        self::assertIsFloat($balance);
    }

    public function testSmsJson(): void {
        $res = $this->sms(['json' => true]);

        self::assertInstanceOf(Sms::class, $res);
    }
}