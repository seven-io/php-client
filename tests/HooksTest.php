<?php declare(strict_types=1);

namespace Seven\Tests;

use Seven\Api\Library\Util;
use Seven\Api\Resource\Hooks\HooksEventType;
use Seven\Api\Resource\Hooks\HooksRequestMethod;
use Seven\Api\Resource\Hooks\SubscribeParams;

class HooksTest extends BaseTest {
    public function testGetHooks(): void {
        $res = $this->resources->hooks->read();

        $this->assertIsBool($res->isSuccess());
        $this->assertIsArray($res->getHooks());

        if (!count($res->getHooks())) {
            $id = $this->testSubscribeHook(false);

            if ($id !== null) {
                $res = $this->resources->hooks->read();
            }
        }

        if (count($res->getHooks()) > 0) {
            $this->assertArrayHasKey(0, $res->getHooks());
        } else {
            $this->markTestSkipped('No hooks available for testing');
            return;
        }

        $h = $res->getHooks()[0];

        $this->assertContains($h->getEventType(), array_column(HooksEventType::cases(), 'value'));
        $this->assertGreaterThan(0, $h->getId());
        $this->assertContains($h->getRequestMethod(), array_column(HooksRequestMethod::cases(), 'name'));
        $this->assertTrue(Util::isValidUrl($h->getTargetUrl()));
    }

    public function testSubscribeHook(bool $delete = true): ?int {
        $params = new SubscribeParams(self::createRandomURL(), HooksEventType::SMS_INBOUND);
        $res = $this->resources->hooks->subscribe($params);

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

    public function testUnsubscribeHook(?int $id = null): void {
        if (!$id) {
            $res = $this->resources->hooks->read();

            $hooks = $res->getHooks();
            $id = count($hooks)
                ? $hooks[0]->getId()
                : $this->testSubscribeHook(false);
        }

        if ($id !== null) {
            $res = $this->resources->hooks->unsubscribe($id);
            $this->assertTrue($res->isSuccess());
        }
    }
}
