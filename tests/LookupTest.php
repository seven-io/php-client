<?php /** @noinspection PhpUnhandledExceptionInspection */
declare(strict_types=1);

namespace Seven\Tests;

use Seven\Api\Response\Lookup\Carrier;

class LookupTest extends BaseTest
{
    public function testRcsCapabilities(): void
    {
        $res = $this->resources->lookup->rcsCapabilities('491716992343');
        $this->assertCount(1, $res);
    }

    public function testFormat(): void
    {
        $res = $this->resources->lookup->format('491716992343');
        $this->assertCount(1, $res);
    }

    public function testFormatFaulty(): void
    {
        $res = $this->resources->lookup->format('000');
        $this->assertCount(1, $res);
        $format = $res[0];
        $this->assertNull($format->getCarrier());
        $this->assertFalse($format->getCountryCode());
        $this->assertNull($format->getCountryIso());
        $this->assertNull($format->getCountryName());
        $this->assertEquals('+', $format->getInternational());
        $this->assertEquals('', $format->getInternationalFormatted());
        $this->assertEquals('', $format->getNational());
        $this->assertNull($format->getNetworkType());
        $this->assertFalse($format->isSuccess());
    }

    public function testFormatMulti(): void
    {
        $res = $this->resources->lookup->format('491716992343', '49179999999');
        $this->assertCount(2, $res);
    }

    public function testMnpMulti(): void
    {
        $arr = $this->resources->lookup->mnp('491716992343');
        $this->assertCount(1, $arr);

        foreach ($arr as $item) {
            $this->assertGreaterThanOrEqual(0, $item->getCode());
            $mnp = $item->getMnp();
            $this->assertNotEmpty($mnp->getCountry());
            $this->assertNotEmpty($mnp->getInternationalFormatted());
            $this->assertIsBool($mnp->isPorted());
            $this->assertNotEmpty($mnp->getMccMnc());
            $this->assertNotEmpty($mnp->getNationalFormat());
            $this->assertIsString($mnp->getNetwork());
            $this->assertNotEmpty($mnp->getNetwork());
            $this->assertIsString($mnp->getNetworkType());
            $this->assertNotEmpty($mnp->getNetworkType());
            $this->assertIsString($mnp->getNumber());
            $this->assertNotEmpty($mnp->getNumber());
            $this->assertGreaterThanOrEqual(0, $item->getPrice());
            $this->assertTrue($item->isSuccess());
        }
    }

    public function testHlr(): void
    {
        $arr = $this->resources->lookup->hlr('491716992343');
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
        $arr = $this->resources->lookup->cnam('491716992343');
        $this->assertCount(1, $arr);
        $cnam = $arr[0];

        $this->assertIsString($cnam->getCode());
        $this->assertNotEmpty($cnam->getCode());
        $this->assertNotEmpty($cnam->getName());
        $this->assertNotEmpty($cnam->getNumber());
        $this->assertTrue($cnam->isSuccess());
    }

    public function testCnamFaulty(): void
    {
        $arr = $this->resources->lookup->cnam('000');
        $this->assertCount(1, $arr);
        $cnam = $arr[0];

        $this->assertIsInt($cnam->getCode());
        $this->assertNull($cnam->getName());
        $this->assertNull($cnam->getNumber());
        $this->assertNull($cnam->isSuccess());
    }
}
