<?php declare(strict_types=1);

namespace Seven\Tests;

use Seven\Api\Resource\Analytics\AbstractAnalytic;

class AnalyticsTest extends BaseTest {
    public function testAnalyticsByDate(): void {
        $res = $this->resources->analytics->byDate();

        $this->assertCount(31, $res);

        foreach ($res as $a) {
            $this->assertEach($a);
            $this->assertNotEmpty($a->getDate());
        }
    }

    private function assertEach(AbstractAnalytic $a): bool {
        $this->assertGreaterThanOrEqual(0, $a->getHLR());
        $this->assertGreaterThanOrEqual(0, $a->getInbound());
        $this->assertGreaterThanOrEqual(0, $a->getMNP());
        $this->assertGreaterThanOrEqual(0, $a->getRCS());
        $this->assertGreaterThanOrEqual(0, $a->getSMS());
        $this->assertGreaterThanOrEqual(0, $a->getUsageEuro());
        $this->assertGreaterThanOrEqual(0, $a->getVoice());

        $total = $a->getSMS()
            + $a->getVoice()
            + $a->getHLR()
            + $a->getMNP()
            + $a->getRCS()// + $a->inbound
        ;
        $isEmpty = 0 === $total;

        $this->assertIsFloat($a->getUsageEuro());

        /*        if ($isEmpty) $this->assertEquals(0, $a->getUsageEuro());
                else $this->assertIsFloat($a->getUsageEuro());*/

        return $isEmpty;
    }

    public function testAnalyticsByLabel(): void {
        $arr = $this->resources->analytics->byLabel();
        //foreach ($arr as $a) {}
        $this->expectNotToPerformAssertions();
    }

    public function testAnalyticsByCountry(): void {
        $arr = $this->resources->analytics->byCountry();
        //foreach ($arr as $item) {}
        $this->expectNotToPerformAssertions();
    }

    public function testAnalyticsBySubaccount(): void {
        $arr = $this->resources->analytics->bySubaccount();

        foreach ($arr as $a) {
            $account = $a->getAccount();
            $this->assertEach($a);

            $this->assertNotEmpty($account);
        }
    }
}
