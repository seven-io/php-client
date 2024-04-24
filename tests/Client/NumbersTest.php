<?php declare(strict_types=1);

namespace Seven\Tests\Client;

use Seven\Api\Constant\PaymentInterval;
use Seven\Api\Params\Numbers\ListAvailableParams;
use Seven\Api\Params\Numbers\OrderParams;
use Seven\Api\Params\Numbers\UpdateParams;

class NumbersTest extends BaseTest
{
    public function testAll(): void
    {
        $availableParams = (new ListAvailableParams)
            ->setCountry('DE')
            ->setFeaturesApplicationToPersonSms(true);
        $offers = $this->client->numbers->listAvailable($availableParams)->getAvailableNumbers();
        $this->assertNotEmpty($offers);

        foreach ($offers as $offer) {
            $this->assertEquals($availableParams->getCountry(), $offer->getCountry());
            $this->assertTrue($offer->getFeatures()->isApplicationToPersonSms());
        }

        $firstOffer = $offers[0];
        $orderParams = (new OrderParams($firstOffer->getNumber()))->setPaymentInterval(PaymentInterval::MONTHLY);
        $order = $this->client->numbers->order($orderParams);
        $this->assertNull($order->getError());
        $this->assertTrue($order->isSuccess());

        $updateParams = (new UpdateParams($firstOffer->getNumber()))
            ->setEmailForward(['php_test@seven.dev'])
            ->setFriendlyName('Friendly Name')
            ->setSmsForward(['491716992343']);
        $updated = $this->client->numbers->update($updateParams);
        $this->assertEquals($updateParams->getFriendlyName(), $updated->getFriendlyName());
        $this->assertEquals($updateParams->getEmailForward(), $updated->getForwardInboundSms()->getEmail()->getAddresses());
        $this->assertEquals($updateParams->getSmsForward(), $updated->getForwardInboundSms()->getSms()->getNumbers());

        $number = $this->client->numbers->get($firstOffer->getNumber());
        $this->assertEquals($orderParams->getPaymentInterval(), $number->getBilling()->getPaymentInterval());

        $actives = $this->client->numbers->listActive();
        $this->assertNotEmpty($actives);

        $deleted = $this->client->numbers->delete($firstOffer->getNumber());
        $this->assertTrue($deleted->isSuccess());
    }
}
