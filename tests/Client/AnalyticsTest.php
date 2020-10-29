<?php declare(strict_types=1);

namespace Sms77\Tests\Client;

use Sms77\Api\Validator\AnalyticsValidator;

class AnalyticsTest extends BaseTest {
    public function testAnalyticsParameterless(): void {
        $res = $this->client->analytics();

        self::assertIsArray($res);

        self::assertCount(31, $res);

        self::assertArrayHasKey(0, $res);

        $validator = new AnalyticsValidator(['p' => $this->client->getApiKey()]);

        $analytics0 = reset($res);

        self::assertTrue($validator->isValidDate($analytics0->date));

        self::assertIsInt($analytics0->economy);
        self::assertIsInt($analytics0->direct);
        self::assertIsInt($analytics0->voice);
        self::assertIsInt($analytics0->hlr);
        self::assertIsInt($analytics0->mnp);
        self::assertIsInt($analytics0->inbound);
        self::assertIsFloat($analytics0->usage_eur);
    }
}