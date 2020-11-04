<?php declare(strict_types=1);

namespace Sms77\Tests\Client;

use Sms77\Api\Constant\HooksConstants;
use Sms77\Api\Library\Util;
use Sms77\Api\Response\WebhookAction;

class HooksTest extends BaseTest {
    public function testGetWebhooks(): void {
        $res = $this->client->getWebhooks();

        self::assertIsBool($res->success);
        self::assertIsArray($res->hooks);

        if (!count($res->hooks)) {
            $this->testSubscribeWebhook(false);

            $res = $this->client->getWebhooks();
        }

        self::assertArrayHasKey(0, $res->hooks);

        $hook = $res->hooks[0];

        self::assertTrue(Util::isValidDate($hook->created, 'Y-m-d H:i:s'));
        self::assertContains($hook->event_type, HooksConstants::EVENT_TYPES);
        self::assertGreaterThan(0, $hook->id);
        self::assertContains($hook->request_method, HooksConstants::REQUEST_METHODS);
        self::assertTrue(Util::isValidUrl($hook->target_url));
    }

    public function testSubscribeWebhook(bool $delete = true): ?int {
        $res = $this->client->subscribeWebhook(
            'http://ho.ok/' . uniqid('', true), HooksConstants::EVENT_TYPE_SMS_INBOUND);

        self::assertActionResponse($res, false);

        if ($delete) {
            $this->testUnsubscribeWebhook($res->id);

            return null;
        }

        return $res->id;
    }

    private static function assertActionResponse(WebhookAction $a, bool $unsubscription): void {
        self::assertIsBool($a->success);

        if ($a->success // no id on error
            && !$unsubscription) { // no id after unsubscription
            self::assertGreaterThan(0, $a->id);
        }
    }

    public function testUnsubscribeWebhook(?int $id = null): void {
        if (!$id) {
            $res = $this->client->getWebhooks();

            $id = count($res->hooks)
                ? $res->hooks[0]->id : $this->testSubscribeWebhook(false);
        }

        self::assertActionResponse($this->client->unsubscribeWebhook($id), true);
    }
}