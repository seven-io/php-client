<?php declare(strict_types=1);

namespace Sms77\Tests\Client;

use Sms77\Api\Constant\StatusCode;
use Sms77\Api\Params\SmsParams;
use Sms77\Api\Params\SmsParamsInterface;

class SmsTest extends BaseTest {
    public function testSms(): void {
        self::assertIsInt($this->sms(new SmsParams()));
    }

    private function sms(SmsParamsInterface $p) {
        return $this->client->sms($p);
    }

    public function testSmsDetails(): void {
        $p = $this->params();
        $res = $this->sms($p->setDetails(true));
        [$code, $booked, $price, $balance, $text,
            $type, $flash, $encoding, $gsm0338, $debug] = explode(PHP_EOL, $res);

        $code = (int)$code;
        self::assertIsInt($code);
        self::assertContains($code, StatusCode::values());

        $formatRow = static function (string $row): string {
            $row = explode(':', $row);
            $row = end($row);
            return trim($row);
        };

        self::assertIsFloat((float)$formatRow((string)$booked));
        self::assertIsFloat((float)$formatRow((string)$price));
        self::assertIsFloat((float)$formatRow((string)$balance));
        self::assertEquals($p->getText(), $formatRow($text));
        self::assertEquals('direct', $formatRow($type));
        self::assertEquals('false', $formatRow($flash));
        self::assertEquals('gsm', $formatRow($encoding));
        self::assertEquals('true', $formatRow($gsm0338));
        self::assertEquals('false', $formatRow($debug));
    }

    private function params(): SmsParams {
        return (new SmsParams())
            ->setText('HI2U! The UNIX time is ' . time() . '.')
            ->setTo($this->recipient);
    }

    public function testSmsJson(): void {
        $p = $this->params();
        $res = $this->client->smsJson($p);

        self::assertEquals($p->getText(), $res->messages[0]->text);
        self::assertEquals(str_replace('+', '', $p->getTo()),
            $res->messages[0]->recipient);
    }

    public function testSmsFiles(): void {
        $p = $this->params();
        $text = '';
        $start = 1;
        $end = 3;
        $fileCount = $end - $start;
        $contents = file_get_contents(__DIR__ . '/../png.base64');
        $validity = 1;
        $password = 'sms77';

        for ($i = $start; $i < $end; $i++) {
            $name = "test$i.png";
            $text .= "TestFile$i: [[$name]]" . PHP_EOL;
            $p->addFile(
                compact('contents', 'name', 'validity', 'password'));
        }

        $json = $this->client->smsJson($p->setText($text));

        $msgLines = explode(PHP_EOL, trim($json->messages[0]->text));

        self::assertCount($fileCount, $msgLines);

        foreach ($msgLines as $line) {
            self::assertNotFalse(strpos($line, 'https://ul.gl/'));
        }
    }
}