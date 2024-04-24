<?php declare(strict_types=1);

namespace Seven\Tests\Client;

use Seven\Api\Constant\HooksEventType;
use Seven\Api\Constant\HooksRequestMethod;
use Seven\Api\Library\Util;
use Seven\Api\Params\Hooks\SubscribeParams;

class HooksTest extends BaseTest
{
    public function testGetHooks(): void
    {
        $res = $this->client->hooks->read();

        $this->assertIsBool($res->isSuccess());
        $this->assertIsArray($res->getHooks());

        if (!count($res->getHooks())) {
            $this->testSubscribeHook(false);

            $res = $this->client->hooks->read();
        }

        $this->assertArrayHasKey(0, $res->getHooks());

        $h = $res->getHooks()[0];

        $this->assertContains($h->getEventType(), array_column(HooksEventType::cases(), 'value'));
        $this->assertGreaterThan(0, $h->getId());
        $this->assertContains($h->getRequestMethod(), array_column(HooksRequestMethod::cases(), 'name'));
        $this->assertTrue(Util::isValidUrl($h->getTargetUrl()));
    }

    public function testSubscribeHook(bool $delete = true): ?int
    {
        $params = new SubscribeParams(self::createRandomURL(), HooksEventType::SMS_INBOUND);
        $res = $this->client->hooks->subscribe($params);

        $id = $res->getId();
        $isSuccess = $res->isSuccess();
        if ($isSuccess) $this->assertGreaterThan(0, $id);
        else $this->assertNull($id);

        if ($delete) {
            $this->testUnsubscribeHook($id);

            return null;
        }

        return $id;
    }

    public function testUnsubscribeHook(?int $id = null): void
    {
        if (!$id) {
            $res = $this->client->hooks->read();

            $hooks = $res->getHooks();
            $id = count($hooks)
                ? $hooks[0]->getId()
                : $this->testSubscribeHook(false);
        }

        $res = $this->client->hooks->unsubscribe($id);
        $this->assertTrue($res->isSuccess());
    }
}
