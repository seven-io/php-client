<?php declare(strict_types=1);

namespace Seven\Tests;

use Seven\Api\Resource\Pricing\PricingParams;

class PricingTest extends BaseTest {
    public function testGermany(): void {
        $params = (new PricingParams)->setCountry('de');
        $res = $this->resources->pricing->get($params);

        self::assertEquals(1, $res->getCountCountries());
        self::assertGreaterThan(0, $res->getCountNetworks());
        self::assertCount(1, $res->getCountries());
    }

    public function testAll(): void {
        $res = $this->resources->pricing->get();

        self::assertGreaterThan(0, $res->getCountCountries());
        self::assertGreaterThan(0, $res->getCountNetworks());
        self::assertCount($res->getCountCountries(), $res->getCountries());
    }
}
