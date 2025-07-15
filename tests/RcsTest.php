<?php declare(strict_types=1);

namespace Seven\Tests;

use DateInterval;
use DateTime;
use Seven\Api\Resource\Rcs\RcsEvent;
use Seven\Api\Resource\Rcs\RcsEventParams;
use Seven\Api\Resource\Rcs\RcsFallbackType;
use Seven\Api\Resource\Rcs\RcsParams;

final class RcsTest extends BaseTest
{
    public function testText(): void
    {
        $params = (new RcsParams('HI2U! The UNIX time is ' . time() . '.', '491716992343'))
            ->setDelay(new DateTime('12-12-2050'))
            ->setFallback(RcsFallbackType::SMS)
        ;
        $res = $this->resources->rcs->dispatch($params);

        $this->assertCount(1, $res->getMessages());
        $msg = $res->getMessages()[0];
        $this->assertEquals($params->getText(), $msg->getText());
        $this->assertEquals(str_replace('+', '', $params->getTo()), $msg->getRecipient());
    }

    public function testDelete(): void
    {
        $params = (new RcsParams('HI', '491716992343'))
            ->setDelay((new DateTime)->add(DateInterval::createFromDateString('1 day')));
        $rcs = $this->resources->rcs->dispatch($params);
        $this->assertNotEmpty($rcs->getMessages());
        $msg = $rcs->getMessages()[0];

        $msgId = $msg->getId();
        if ($msgId !== null) {
            $res = $this->resources->rcs->delete($msgId);
            $this->assertTrue($res->isSuccess());
        }
    }

    public function testEvent(): void
    {
        $params = new RcsEventParams('4915237035388', RcsEvent::IS_TYPING);
        $res = $this->resources->rcs->event($params);

        $this->assertTrue($res->isSuccess());
    }
}
