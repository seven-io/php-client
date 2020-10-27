<?php

namespace Sms77\Tests\Client;

use Sms77\Api\Analytics;
use Sms77\Api\Validator\AnalyticsValidator;

class AnalyticsTest extends BaseTest {
    public function testAnalyticsParameterless() {
        $res = $this->client->analytics();

        $res = json_decode($res);

        self::assertTrue(is_array($res));

        self::assertTrue(array_key_exists(0, $res));

        $validator = new AnalyticsValidator(['p' => $this->client->getApiKey()]);

        $analytics0 = new Analytics($res[0]);

        self::assertTrue($validator->isValidDate($analytics0->date));
        self::assertTrue(is_int($analytics0->economy));
        self::assertTrue(is_int($analytics0->direct));
        self::assertTrue(is_int($analytics0->voice));
        self::assertTrue(is_int($analytics0->hlr));
        self::assertTrue(is_int($analytics0->mnp));
        self::assertTrue(is_int($analytics0->inbound));
        self::assertTrue(is_float($analytics0->usage_eur));
    }
}