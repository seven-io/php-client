<?php declare(strict_types=1);

namespace Seven\Tests\Client;

use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Params\Subaccounts\CreateSubaccountParams;
use Seven\Api\Response\Subaccounts\Subaccount;

class SubaccountsTest extends BaseTest
{
    public function testCreateFail(): void
    {
        $this->expectException(InvalidRequiredArgumentException::class);

        $params = new CreateSubaccountParams('', '');
        $this->client->subaccounts->create($params);
    }

    public function testCreate(): Subaccount
    {
        $params = new CreateSubaccountParams(
            'Tommy Tester',
            sprintf('tommy.tester.%d@seven.dev', time())
        );
        $res = $this->client->subaccounts->create($params);

        $this->assertTrue($res->isSuccess());
        $this->assertNull($res->getError());
        $this->assertNotNull($res->getSubaccount());
        $this->assertSubaccount($res->getSubaccount());

        return $res->getSubaccount();
    }

    private function assertSubaccount(Subaccount $subaccount): void
    {
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
    public function testTransferCredits(Subaccount $subaccount): Subaccount
    {
        $id = $subaccount->getId();
        $amount = 12.34;
        $res = $this->client->subaccounts->transferCredits($id, $amount);

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
    public function testUpdate(Subaccount $subaccount): Subaccount
    {
        $id = $subaccount->getId();
        $amount = 12.34;
        $threshold = 123.456;
        $res = $this->client->subaccounts->update($id, $amount, $threshold);

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
    public function testDelete(Subaccount $subaccount): void
    {
        $res = $this->client->subaccounts->delete($subaccount->getId());

        if ($res->isSuccess()) {
            $this->assertNull($res->getError());
        } else {
            $this->assertIsLengthyString($res->getError());
        }
    }

    public function testRead(): void
    {
        $res = $this->client->subaccounts->read();

        $this->assertIsArray($res);
        array_walk($res, [$this, 'assertSubaccount']);
    }
}
