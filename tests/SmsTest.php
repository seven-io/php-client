<?php declare(strict_types=1);

namespace Seven\Tests;

use DateTime;
use Seven\Api\Resource\Sms\SmsParams;

class SmsTest extends BaseTest
{
    public function testSms(): void
    {
        $params = (new SmsParams('HI2U! The UNIX time is ' . time() . '.', '491716992343'));
        $params->setText('Müller');
        $params->setDelay(new DateTime('2050-12-31'));
        $res = $this->resources->sms->dispatch($params);

        $msg = $res->getMessages()[0];
        $this->assertEquals($params->getText(), $msg->getText());
        $this->assertEquals(str_replace('+', '', $params->getTo()[0]), $msg->getRecipient());

        $this->resources->sms->delete($msg->getId());
    }

    public function testSmsFiles(): void
    {
        $p = (new SmsParams('HI2U! The UNIX time is ' . time() . '.', '491716992343'));
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

        $json = $this->resources->sms->dispatch($p->setText($text));
        $msg = trim($json->getMessages()[0]->getText());

        $links = (int)preg_match_all('#(https://svn.me/)#', $msg);
        $this->assertEquals($fileCount, $links);
    }

    public function testDelete(): void
    {
        $params = (new SmsParams('HI2U! The UNIX time is ' . time() . '.', '491716992343'))
            ->addTo('4917987654321')
            ->setDelay(new DateTime('2050-12-31'));
        $sms = $this->resources->sms->dispatch($params);
        $this->assertNotEmpty($sms->getMessages());
        $msg = $sms->getMessages()[0];

        $res = $this->resources->sms->delete($msg->getId());
        if ($res->isSuccess()) $this->assertSameSize($sms->getMessages(), $res->getDeleted());
        else $this->assertNull($res->getDeleted());
    }
}
