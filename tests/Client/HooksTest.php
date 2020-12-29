<?php declare(strict_types=1);

namespace Sms77\Tests\Client;

use Sms77\Api\Constant\HooksConstants;
use Sms77\Api\Library\Util;
use Sms77\Api\Response\HookAction;

class HooksTest extends BaseTest {
    public function testGetHooks(): void {
        $res = $this->client->getHooks();

        self::assertIsBool($res->success);
        self::assertIsArray($res->hooks);

        if (!count($res->hooks)) {
            $this->testSubscribeHook(false);

            $res = $this->client->getHooks();
        }

        self::assertArrayHasKey(0, $res->hooks);

        $hook = $res->hooks[0];

        self::assertTrue(Util::isValidDate($hook->created, 'Y-m-d H:i:s'));
        self::assertContains($hook->event_type, HooksConstants::EVENT_TYPES);
        self::assertGreaterThan(0, $hook->id);
        self::assertContains($hook->request_method, HooksConstants::REQUEST_METHODS);
        self::assertTrue(Util::isValidUrl($hook->target_url));
    }

    public function testSubscribeHook(bool $delete = true): ?int {
        $res = $this->client->subscribeHook(
            'http://ho.ok/' . uniqid('', true),
            HooksConstants::EVENT_TYPE_SMS_INBOUND);

        self::assertActionResponse($res, false);

        if ($delete) {
            $this->testUnsubscribeHook($res->id);

            return null;
        }

        return $res->id;
    }

    private static function assertActionResponse(HookAction $a, bool $unsubscription): void {
        self::assertIsBool($a->success);

        if ($a->success // no id on error
            && !$unsubscription) { // no id after unsubscription
            self::assertGreaterThan(0, $a->id);
        }
    }

    public function testUnsubscribeHook(?int $id = null): void {
        if (!$id) {
            $res = $this->client->getHooks();

            $id = count($res->hooks)
                ? $res->hooks[0]->id : $this->testSubscribeHook(false);
        }

        self::assertActionResponse($this->client->unsubscribeHook($id), true);
    }
}