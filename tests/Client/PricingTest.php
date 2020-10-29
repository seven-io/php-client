<?php declare(strict_types=1);

namespace Sms77\Tests\Client;

use Sms77\Api\Response\Pricing;

class PricingTest extends BaseTest {
    public function testPricingGermany(): void {
        /** @var Pricing $res */
        $res = $this->client->pricing(true, 'de');

        self::assertEquals(1, $res->countCountries);
        self::assertGreaterThan(0, $res->countNetworks);
        self::assertCount(1, $res->countries);
    }

    public function testPricingGermanyCsv(): void {
        /** @var Pricing $res */
        $res = $this->client->pricing(false, 'de');

        self::assertIsString($res);
    }

    public function testPricing(): void {
        /** @var Pricing $res */
        $res = $this->client->pricing();

        self::assertGreaterThan(0, $res->countCountries);
        self::assertGreaterThan(0, $res->countNetworks);
        self::assertCount($res->countCountries, $res->countries);
    }
}