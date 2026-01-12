<?php declare(strict_types=1);

namespace Seven\Tests;

class BalanceTest extends AbstractTestCase
{
    public function testBalance(): void
    {
        $res = $this->resources->balance->get();

        $this->assertNotEmpty($res->getCurrency());
    }
}
