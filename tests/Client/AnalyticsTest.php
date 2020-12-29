<?php declare(strict_types=1);

namespace Sms77\Tests\Client;

use Sms77\Api\Response\AbstractAnalytic;
use Sms77\Api\Validator\BaseValidator;

class AnalyticsTest extends BaseTest {
    private function assertResponse(array $res): array {
        self::assertIsArray($res);

        return $res;
    }

    private function assertEach(AbstractAnalytic $a): bool {
        self::assertIsInt($a->economy);
        self::assertIsInt($a->direct);
        self::assertIsInt($a->voice);
        self::assertIsInt($a->hlr);
        self::assertIsInt($a->mnp);
        self::assertIsInt($a->inbound);

        $isEmpty = 0 ===
            $a->economy + $a->direct + $a->voice + $a->hlr + $a->mnp + $a->inbound;

        if ($isEmpty) {
            self::assertEquals(0, $a->usage_eur);
        } else {
            self::assertIsFloat($a->usage_eur);
        }

        return $isEmpty;
    }

    public function testAnalyticsGroupByDate(): void {
        $res = $this->client->analyticsByDate();

        self::assertCount(31, $res);

        foreach ($this->assertResponse($res) as $a) {
            $this->assertEach($a);

            self::assertTrue(BaseValidator::isValidDate($a->date));
        }
    }

    public function testAnalyticsGroupByLabel(): void {
        foreach ($this->assertResponse($this->client->analyticsByLabel()) as $a) {
            $isEmpty = $this->assertEach($a);

            if ($isEmpty) {
                self::assertEquals(0, $a->label);
            } else {
                self::assertIsString($a->label);
            }
        }
    }

    public function testAnalyticsGroupByCountry(): void {
        foreach ($this->assertResponse($this->client->analyticsByCountry()) as $a) {
            $isEmpty = $this->assertEach($a);

            if ($isEmpty) {
                self::assertEquals(0, $a->country);
            } else {
                self::assertIsString($a->country);
                self::assertNotEmpty($a->country);
            }
        }
    }

    public function testAnalyticsGroupBySubaccount(): void {
        foreach ($this->assertResponse($this->client->analyticsBySubaccount()) as $a) {
            $this->assertEach($a);

            self::assertIsString($a->account);
            self::assertNotEmpty($a->account);
        }
    }
}