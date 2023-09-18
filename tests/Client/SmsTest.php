<?php declare(strict_types=1);

namespace Seven\Tests\Client;

use DateInterval;
use DateTime;
use Seven\Api\Params\SmsParams;

class SmsTest extends BaseTest {
    public function testSms(): void {
        $res = $this->client->sms->dispatch($this->params);

        $msg = $res->getMessages()[0];
        $this->assertEquals($this->params->getText(), $msg->getText());
        $this->assertEquals(str_replace('+', '', $this->params->getTo()[0]), $msg->getRecipient());
    }

    public function testSmsFiles(): void {
        $p = clone $this->params;
        $text = '';
        $start = 1;
        $end = 3;
        $fileCount = $end - $start;
        $contents = 'dummy content';
        $validity = 1;
        $password = 'seven';

        for ($i = $start; $i < $end; $i++) {
            $name = 'test' . $i . '.png';
            $text .= sprintf('TestFile%d: [[%s]]', $i, $name);
            $file = compact('contents', 'name', 'password', 'validity');
            $p->addFile($file);
        }

        $json = $this->client->sms->dispatch($p->setText($text));
        $msg = trim($json->getMessages()[0]->getText());

        $links = (int)preg_match_all('#(https://svn.me/)#', $msg);
        $this->assertEquals($fileCount, $links);
    }

    public function testDelete(): void {
        $params = (clone $this->params)
            ->addTo('4917987654321')
            ->setDelay((new DateTime)->add(DateInterval::createFromDateString('1 day')));
        $sms = $this->client->sms->dispatch($params);
        $this->assertNotEmpty($sms->getMessages());
        $msg = $sms->getMessages()[0];

        $res = $this->client->sms->delete($msg->getId());
        if ($res->isSuccess()) $this->assertSameSize($sms->getMessages(), $res->getDeleted());
        else $this->assertNull($res->getDeleted());
    }

    protected function setUp(): void {
        $this->params = new SmsParams('HI2U! The UNIX time is ' . time() . '.', '491716992343');
    }
}
