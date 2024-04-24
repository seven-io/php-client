<?php declare(strict_types=1);

namespace Seven\Tests;

class PricingTest extends BaseTest
{
    public function testGermany(): void
    {
        $res = $this->resources->pricing->get('de');

        self::assertEquals(1, $res->getCountCountries());
        self::assertGreaterThan(0, $res->getCountNetworks());
        self::assertCount(1, $res->getCountries());
    }

    public function testJson(): void
    {
        $res = $this->resources->pricing->get();

        self::assertGreaterThan(0, $res->getCountCountries());
        self::assertGreaterThan(0, $res->getCountNetworks());
        self::assertCount($res->getCountCountries(), $res->getCountries());
    }
}
