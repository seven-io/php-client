<?php /** @noinspection PhpUnhandledExceptionInspection */
declare(strict_types=1);

namespace Seven\Tests;

use Seven\Api\Resource\Lookup\Carrier;

class LookupTest extends BaseTest {
    public function testRcsCapabilities(): void {
        $res = $this->resources->lookup->rcsCapabilities('491716992343');
        $this->assertCount(1, $res);
    }

    public function testFormat(): void {
        $res = $this->resources->lookup->format('491716992343');
        $this->assertCount(1, $res);
    }

    public function testFormatFaulty(): void {
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

    public function testFormatMulti(): void {
        $res = $this->resources->lookup->format('491716992343', '49179999999');
        $this->assertCount(2, $res);
    }

    public function testMnpMulti(): void {
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

    public function testHlr(): void {
        $arr = $this->resources->lookup->hlr('491716992343');
        $this->assertCount(1, $arr);
        $hlr = $arr[0];

        $this->assertNotEmpty($hlr->getCountryCode());
        $this->assertNotEmpty($hlr->getCountryName());
        $this->assertNotEmpty($hlr->getCountryPrefix());
        $this->assertCarrier($hlr->getCurrentCarrier());
        $this->assertIsString($hlr->getGsmCode());
        $this->assertNotEmpty($hlr->getGsmMessage());
        $this->assertNotEmpty($hlr->getInternationalFormatNumber());
        $this->assertNotEmpty($hlr->getInternationalFormatted());
        $this->assertTrue($hlr->isLookupOutcome());
        $this->assertNotEmpty($hlr->getLookupOutcomeMessage());
        $this->assertNotEmpty($hlr->getNationalFormatNumber());
        $this->assertCarrier($hlr->getOriginalCarrier());
        $this->assertNotEmpty($hlr->getPorted());
        $this->assertNotEmpty($hlr->getReachable());
        $this->assertNotEmpty($hlr->getRoaming());
        $this->assertTrue($hlr->isStatus());
        $this->assertNotEmpty($hlr->getStatusMessage());
        $this->assertNotEmpty($hlr->getValidNumber());
    }

    private function assertCarrier(Carrier $c, bool $faulty = false): void {
        if ($faulty) {
            $this->assertTrue($c->getCountry() === null || $c->getCountry() === '' || strlen($c->getCountry()) >= 0);
            $this->assertTrue($c->getName() === null || is_string($c->getName()));
            $this->assertTrue($c->getNetworkCode() === null || $c->getNetworkCode() === '' || strlen($c->getNetworkCode()) >= 0);
            $this->assertTrue($c->getNetworkType() === null || is_string($c->getNetworkType()));
        } else {
            $this->assertNotEmpty($c->getCountry());
            $this->assertNotEmpty($c->getName());
            $this->assertNotEmpty($c->getNetworkCode());
            $this->assertNotEmpty($c->getNetworkType());
        }
    }

    public function testHlrFaulty(): void {
        $arr = $this->resources->lookup->hlr('000');
        $this->assertCount(1, $arr);
        $hlr = $arr[0];

        $this->assertTrue($hlr->getCountryCode() === null || $hlr->getCountryCode() === '' || is_string($hlr->getCountryCode()));
        $this->assertNull($hlr->getCountryName());
        $this->assertFalse($hlr->getCountryPrefix());
        $this->assertCarrier($hlr->getCurrentCarrier(), true);
        $this->assertTrue($hlr->getGsmCode() === null || $hlr->getGsmCode() === '0');
        $this->assertTrue($hlr->getGsmMessage() === null || is_string($hlr->getGsmMessage()));
        $this->assertEmpty($hlr->getInternationalFormatNumber());
        $this->assertEmpty($hlr->getInternationalFormatted());
        $this->assertIsBool($hlr->isLookupOutcome());
        $this->assertNotEmpty($hlr->getLookupOutcomeMessage());
        $this->assertEmpty($hlr->getNationalFormatNumber());
        $this->assertCarrier($hlr->getOriginalCarrier(), true);
        $this->assertNotEmpty($hlr->getPorted());
        $this->assertNotEmpty($hlr->getReachable());
        $this->assertNotEmpty($hlr->getRoaming());
        $this->assertTrue($hlr->isStatus());
        $this->assertNotEmpty($hlr->getStatusMessage());
        $this->assertNotEmpty($hlr->getValidNumber());
    }

    public function testCnam(): void {
        $arr = $this->resources->lookup->cnam('491716992343');
        $this->assertCount(1, $arr);
        $cnam = $arr[0];

        $this->assertIsString($cnam->getCode());
        $this->assertNotEmpty($cnam->getCode());
        $this->assertNotEmpty($cnam->getName());
        $this->assertNotEmpty($cnam->getNumber());
        $this->assertTrue($cnam->isSuccess());
    }

    public function testCnamFaulty(): void {
        $arr = $this->resources->lookup->cnam('000');
        $this->assertCount(1, $arr);
        $cnam = $arr[0];

        $this->assertIsInt($cnam->getCode());
        $this->assertNull($cnam->getName());
        $this->assertNull($cnam->getNumber());
        $this->assertNull($cnam->isSuccess());
    }
}
