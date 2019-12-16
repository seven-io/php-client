<?php

namespace Sms77\Tests\Client;

class PricingTest extends BaseTest
{
    const COUNT_COUNTRIES = 'countCountries';
    const COUNTRIES = 'countries';

    public function testPricing()
    {
        $res = $this->client->pricing();
        $res = json_decode($res, false);

        $this->assertObjectHasAttribute(self::COUNT_COUNTRIES, $res);
        $this->assertObjectHasAttribute(self::COUNTRIES, $res);
        $this->assertObjectHasAttribute('countNetworks', $res);

        $this->assertNotEquals(0, $res->{self::COUNT_COUNTRIES});

        $this->assertEquals($res->{self::COUNT_COUNTRIES}, count($res->{self::COUNTRIES}));
        $this->assertCount($res->{self::COUNT_COUNTRIES}, $res->{self::COUNTRIES});
    }
}