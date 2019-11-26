<?php

namespace Sms77\Tests\Client;

class PricingTest extends BaseTest
{
    function testPricing()
    {
        $res = $this->client->pricing();
        $res = json_decode($res);

        $this->assertObjectHasAttribute('countCountries', $res);
        $this->assertObjectHasAttribute('countNetworks', $res);
        $this->assertObjectHasAttribute('countries', $res);

        $this->assertNotEquals(0, $res->countCountries);

        $this->assertEquals($res->countCountries, count($res->countries));
    }
}