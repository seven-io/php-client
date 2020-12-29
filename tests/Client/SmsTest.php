<?php declare(strict_types=1);

namespace Sms77\Tests\Client;

use Sms77\Api\Constant\StatusCode;
use Sms77\Api\Params\SmsParams;
use Sms77\Api\Params\SmsParamsInterface;

class SmsTest extends BaseTest {
    private function params(): SmsParams {
        return (new SmsParams())
            ->setText('HI2U! The UNIX time is ' . time() . '.')
            ->setTo($this->recipient);
    }

    private function sms(SmsParamsInterface $p) {
        return $this->client->sms($p);
    }

    public function testSms(): void {
        self::assertIsInt($this->sms(new SmsParams()));
    }

    public function testSmsDetails(): void {
        $p = $this->params();
        $res = $this->sms($p->setDetails(true));
        [$code, $booked, $price, $balance, $text,
            $type, $flash, $encoding, $gsm0338, $debug] = explode(PHP_EOL, $res);

        $code = (int)$code;
        self::assertIsInt($code);
        self::assertContains($code, StatusCode::values());

        $booked = explode(':', $booked);
        $booked = (float)end($booked);
        self::assertIsFloat($booked);

        $price = explode(':', $price);
        $price = (float)end($price);
        self::assertIsFloat($price);

        $balance = explode(':', $balance);
        $balance = (float)end($balance);
        self::assertIsFloat($balance);

        $text = explode(':', $text);
        $text = end($text);
        $text = trim($text);
        self::assertEquals($p->getText(), $text);

        $type = explode(':', $type);
        $type = end($type);
        $type = trim($type);
        self::assertEquals('direct', $type);

        $flash = explode(':', $flash);
        $flash = end($flash);
        $flash = trim($flash);
        self::assertEquals('false', $flash);

        $encoding = explode(':', $encoding);
        $encoding = end($encoding);
        $encoding = trim($encoding);
        self::assertEquals('gsm',$encoding);

        $gsm0338 = explode(':', $gsm0338);
        $gsm0338 = end($gsm0338);
        $gsm0338 = trim($gsm0338);
        self::assertEquals('true', $gsm0338);

        $debug = explode(':', $debug);
        $debug = end($debug);
        $debug = trim($debug);
        self::assertEquals('false', $debug);
    }

    public function testSmsJson(): void {
        $p = $this->params();
        $res = $this->client->smsJson($p);

        self::assertEquals($p->getText(), $res->messages[0]->text);
        self::assertEquals(str_replace('+', '', $p->getTo()),
            $res->messages[0]->recipient);
    }
}