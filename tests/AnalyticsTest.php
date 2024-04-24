<?php declare(strict_types=1);

namespace Seven\Tests;

use Seven\Api\Response\Analytics\AbstractAnalytic;
use Seven\Api\Response\Analytics\AnalyticByDate;
use Seven\Api\Response\Analytics\AnalyticByLabel;
use Seven\Api\Response\Analytics\AnalyticBySubaccount;

class AnalyticsTest extends BaseTest
{
    public function testAnalyticsGroupByDate(): void
    {
        $res = $this->resources->analytics->byDate();

        $this->assertCount(31, $res);

        foreach ($this->assertResponse($res) as $a) {
            /** @var AnalyticByDate $a */
            $this->assertEach($a);
            $this->assertIsLengthyString($a->getDate());
        }
    }

    /**
     * @return AbstractAnalytic[]
     */
    private function assertResponse(array $res): array
    {
        $this->assertIsArray($res);

        return $res;
    }

    private function assertEach(AbstractAnalytic $a): bool
    {
        $this->assertGreaterThanOrEqual(0, $a->getHLR());
        $this->assertGreaterThanOrEqual(0, $a->getInbound());
        $this->assertGreaterThanOrEqual(0, $a->getMNP());
        $this->assertGreaterThanOrEqual(0, $a->getSMS());
        $this->assertGreaterThanOrEqual(0, $a->getUsageEuro());
        $this->assertGreaterThanOrEqual(0, $a->getVoice());

        $total = $a->getSMS()
            + $a->getVoice()
            + $a->getHLR()
            + $a->getMNP()// + $a->inbound
        ;
        $isEmpty = 0 === $total;

        $this->assertIsFloat($a->getUsageEuro());

        /*        if ($isEmpty) $this->assertEquals(0, $a->getUsageEuro());
                else $this->assertIsFloat($a->getUsageEuro());*/

        return $isEmpty;
    }

    public function testAnalyticsGroupByLabel(): void
    {
        foreach ($this->assertResponse($this->resources->analytics->byLabel()) as $a) {
            /** @var AnalyticByLabel $a */
            $this->assertIsString($a->getLabel());
        }
    }

    public function testAnalyticsGroupByCountry(): void
    {
        $this->assertResponse($this->resources->analytics->byCountry());
    }

    public function testAnalyticsGroupBySubaccount(): void
    {
        foreach ($this->assertResponse($this->resources->analytics->bySubaccount()) as $a) {
            /** @var AnalyticBySubaccount $a */
            $account = $a->getAccount();
            $this->assertEach($a);

            $this->assertIsString($account);
            $this->assertNotEmpty($account);
        }
    }
}
