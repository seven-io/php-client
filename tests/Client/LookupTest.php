<?php /** @noinspection PhpUnhandledExceptionInspection */
declare(strict_types=1);

namespace Seven\Tests\Client;

use Seven\Api\Response\Lookup\Carrier;

class LookupTest extends BaseTest
{
    public function testRcsCapabilities(): void
    {
        $res = $this->client->lookup->rcsCapabilities('491716992343');
        $this->assertCount(1, $res);
    }

    public function testFormat(): void
    {
        $res = $this->client->lookup->format('491716992343');
        $this->assertCount(1, $res);
    }

    public function testFormatMulti(): void
    {
        $res = $this->client->lookup->format('491716992343', '49179999999');
        $this->assertCount(2, $res);
    }

    public function testMnpMulti(): void
    {
        $arr = $this->client->lookup->mnp('491716992343');
        $this->assertCount(1, $arr);

        foreach ($arr as $item) {
            $this->assertIsInt($item->getCode());
            $mnp = $item->getMnp();
            $this->assertIsString($mnp->getCountry());
            $this->assertIsString($mnp->getInternationalFormatted());
            $this->assertIsBool($mnp->isPorted());
            $this->assertIsString($mnp->getMccMnc());
            $this->assertIsString($mnp->getNationalFormat());
            $this->assertIsString($mnp->getNetwork());
            $this->assertIsString($mnp->getNumber());
            $this->assertIsNumeric($item->getPrice());
            $this->assertTrue($item->isSuccess());
        }
    }

    public function testHlr(): void
    {
        $arr = $this->client->lookup->hlr('491716992343');
        $this->assertCount(1, $arr);

        foreach ($arr as $item) {
            $this->assertNotEmpty($item->getCountryCode());
            $this->assertNotEmpty($item->getCountryName());
            $this->assertNotEmpty($item->getCountryPrefix());
            $this->assertCarrier($item->getCurrentCarrier());
            $this->assertIsLengthyString($item->getGsmCode());
            $this->assertNotEmpty($item->getGsmMessage());
            $this->assertNotEmpty($item->getInternationalFormatNumber());
            $this->assertNotEmpty($item->getInternationalFormatted());
            $this->assertTrue($item->isLookupOutcome());
            $this->assertNotEmpty($item->getLookupOutcomeMessage());
            $this->assertNotEmpty($item->getNationalFormatNumber());
            $this->assertCarrier($item->getOriginalCarrier());
            $this->assertNotEmpty($item->getPorted());
            $this->assertNotEmpty($item->getReachable());
            $this->assertNotEmpty($item->getRoaming());
            $this->assertTrue($item->isStatus());
            $this->assertNotEmpty($item->getStatusMessage());
            $this->assertNotEmpty($item->getValidNumber());
        }
    }

    private function assertCarrier(Carrier $c): void
    {
        $this->assertNotEmpty($c->getCountry());
        $this->assertNotEmpty($c->getName());
        $this->assertNotEmpty($c->getNetworkCode());
        $this->assertNotEmpty($c->getNetworkType());
    }

    public function testCnam(): void
    {
        $arr = $this->client->lookup->cnam('491716992343');
        $this->assertCount(1, $arr);

        foreach ($arr as $item) {
            $this->assertNotEmpty($item->getCode());
            $this->assertNotEmpty($item->getName());
            $this->assertNotEmpty($item->getNumber());
            $this->assertTrue($item->isSuccess());
        }
    }
}
