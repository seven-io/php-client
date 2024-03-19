<?php declare(strict_types=1);

namespace Seven\Tests\Client;

use DateInterval;
use DateTime;
use Seven\Api\Params\Rcs\RcsEvent;
use Seven\Api\Params\Rcs\RcsEventParams;
use Seven\Api\Params\Rcs\RcsParams;

final class RcsTest extends BaseTest
{
    public function testText(): void
    {
        $params = new RcsParams('HI2U! The UNIX time is ' . time() . '.', '491716992343');
        $res = $this->client->rcs->dispatch($params);

        $this->assertCount(1, $res->getMessages());
        $msg = $res->getMessages()[0];
        $this->assertEquals($params->getText(), $msg->getText());
        $this->assertEquals(str_replace('+', '', $params->getTo()), $msg->getRecipient());
    }

    public function testDelete(): void
    {
        $params = (new RcsParams('HI', '491716992343'))
            ->setDelay((new DateTime)->add(DateInterval::createFromDateString('1 day')));
        $rcs = $this->client->rcs->dispatch($params);
        $this->assertNotEmpty($rcs->getMessages());
        $msg = $rcs->getMessages()[0];

        $res = $this->client->rcs->delete($msg->getId());
        $this->assertTrue($res->isSuccess());
    }

    public function testEvent(): void
    {
        $params = new RcsEventParams('4915237035388', RcsEvent::IS_TYPING);
        $res = $this->client->rcs->event($params);

        $this->assertTrue($res->isSuccess());
    }
}
