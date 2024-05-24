<?php declare(strict_types=1);

namespace Seven\Tests;

use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Resource\Subaccounts\AutoChargeParams;
use Seven\Api\Resource\Subaccounts\CreateParams;
use Seven\Api\Resource\Subaccounts\Subaccount;
use Seven\Api\Resource\Subaccounts\TransferCreditsParams;

class SubaccountsTest extends BaseTest {
    public function testCreateFail(): void {
        $this->expectException(InvalidRequiredArgumentException::class);

        $params = new CreateParams('', '');
        $this->resources->subaccounts->create($params);
    }

    public function testCreate(): Subaccount {
        $params = new CreateParams(
            'Tommy Tester',
            sprintf('tommy.tester.%d@seven.dev', time())
        );
        $res = $this->resources->subaccounts->create($params);

        $this->assertTrue($res->isSuccess());
        $this->assertNull($res->getError());
        $this->assertNotNull($res->getSubaccount());
        $this->assertSubaccount($res->getSubaccount());

        return $res->getSubaccount();
    }

    private function assertSubaccount(Subaccount $subaccount): void {
        $this->assertGreaterThan(0, $subaccount->getId());
        $this->assertGreaterThanOrEqual(0, $subaccount->getTotalUsage());

        $autoTopup = $subaccount->getAutoTopup();
        $amount = $autoTopup->getAmount();
        $threshold = $autoTopup->getThreshold();
        if ($amount !== null) $this->assertGreaterThanOrEqual(0, $amount);
        if ($threshold !== null) $this->assertGreaterThanOrEqual(0, $threshold);

        $contact = $subaccount->getContact();
        $this->assertIsLengthyString($contact->getName());
        $this->assertIsLengthyString($contact->getEmail());
    }

    /**
     * @depends testCreate
     */
    public function testTransferCredits(Subaccount $subaccount): Subaccount {
        $id = $subaccount->getId();
        $amount = 1.23;
        $params = new TransferCreditsParams($id, $amount);
        $res = $this->resources->subaccounts->transferCredits($params);

        if ($res->isSuccess()) {
            $this->assertNull($res->getError());
        } else {
            $this->assertIsLengthyString($res->getError());
        }

        return $subaccount;
    }

    /**
     * @depends testTransferCredits
     */
    public function testUpdate(Subaccount $subaccount): Subaccount {
        $id = $subaccount->getId();
        $amount = 1.23;
        $threshold = 12.34;
        $params = new AutoChargeParams($id, $amount, $threshold);
        $res = $this->resources->subaccounts->autoCharge($params);

        if ($res->isSuccess()) {
            $this->assertNull($res->getError());
        } else {
            $this->assertIsLengthyString($res->getError());
        }

        return $subaccount;
    }

    /**
     * @depends testUpdate
     */
    public function testDelete(Subaccount $subaccount): void {
        $res = $this->resources->subaccounts->delete($subaccount->getId());

        if ($res->isSuccess()) {
            $this->assertNull($res->getError());
        } else {
            $this->assertIsLengthyString($res->getError());
        }
    }

    public function testRead(): void {
        $res = $this->resources->subaccounts->read();

        $this->assertIsArray($res);
        array_walk($res, [$this, 'assertSubaccount']);
    }
}
