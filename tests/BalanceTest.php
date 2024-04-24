<?php declare(strict_types=1);

namespace Seven\Tests;

class BalanceTest extends BaseTest
{
    public function testBalance(): void
    {
        $res = $this->resources->balance->get();

        $this->assertNotEmpty($res->getCurrency());
    }
}
