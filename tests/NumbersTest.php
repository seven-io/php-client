<?php declare(strict_types=1);

namespace Seven\Tests;

use Seven\Api\Params\Numbers\ListAvailableParams;
use Seven\Api\Params\Numbers\OrderParams;
use Seven\Api\Params\Numbers\UpdateParams;
use Seven\Api\Resource\Numbers\PaymentInterval;

class NumbersTest extends BaseTest {
    public function testAll(): void {
        $availableParams = (new ListAvailableParams)
            ->setCountry('DE')
            ->setFeaturesApplicationToPersonSms(true);
        $offers = $this->resources->numbers->listAvailable($availableParams)->getAvailableNumbers();
        $this->assertNotEmpty($offers);

        foreach ($offers as $offer) {
            $this->assertEquals($availableParams->getCountry(), $offer->getCountry());
            $this->assertTrue($offer->getFeatures()->isApplicationToPersonSms());
        }

        $firstOffer = $offers[0];
        $orderParams = (new OrderParams($firstOffer->getNumber()))->setPaymentInterval(PaymentInterval::MONTHLY);
        $order = $this->resources->numbers->order($orderParams);
        $this->assertNull($order->getError());
        $this->assertTrue($order->isSuccess());

        $updateParams = (new UpdateParams($firstOffer->getNumber()))
            ->setEmailForward(['php_test@seven.dev'])
            ->setFriendlyName('Friendly Name')
            ->setSmsForward(['491716992343']);
        $updated = $this->resources->numbers->update($updateParams);
        $this->assertEquals($updateParams->getFriendlyName(), $updated->getFriendlyName());
        $this->assertEquals($updateParams->getEmailForward(), $updated->getForwardInboundSms()->getEmail()->getAddresses());
        $this->assertEquals($updateParams->getSmsForward(), $updated->getForwardInboundSms()->getSms()->getNumbers());

        $number = $this->resources->numbers->get($firstOffer->getNumber());
        $this->assertEquals($orderParams->getPaymentInterval(), $number->getBilling()->getPaymentInterval());

        $actives = $this->resources->numbers->listActive();
        $this->assertNotEmpty($actives);

        $deleted = $this->resources->numbers->delete($firstOffer->getNumber());
        $this->assertTrue($deleted->isSuccess());
    }
}
