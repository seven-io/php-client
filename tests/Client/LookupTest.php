<?php declare(strict_types=1);

namespace Sms77\Tests\Client;

use Sms77\Api\Exception\UnexpectedApiResponseException;
use Sms77\Api\Response\Carrier;
use Sms77\Api\Response\LookupMnp;
use Sms77\Api\Response\Mnp;
use Sms77\Api\Validator\LookupValidator;

class LookupTest extends BaseTest {
    public function testLookupFormat(): void {
        $res = $this->client->lookupFormat($this->recipient);

        self::assertIsObject($res);
        self::assertIsBool($res->success);
    }

    /** @throws UnexpectedApiResponseException */
    public function testLookupMnp(): void {
        self::assertTrue(LookupValidator::isValidMobileNetworkShortName(
            $this->client->lookupMnp($this->recipient)));
    }

    /** @throws UnexpectedApiResponseException */
    public function testLookupMnpJson(): void {
        $res = $this->client->lookupMnp($this->recipient, true);

        self::assertIsObject($res);
        self::assertInstanceOf(LookupMnp::class, $res);
        self::assertIsInt($res->code);
        self::assertInstanceOf(Mnp::class, $res->mnp);
        self::assertIsString($res->mnp->country);
        self::assertIsString($res->mnp->international_formatted);
        self::assertIsBool($res->mnp->isPorted);
        self::assertIsString($res->mnp->mccmnc);
        self::assertIsString($res->mnp->national_format);
        self::assertIsString($res->mnp->network);
        self::assertIsString($res->mnp->number);
        self::assertIsFloat($res->price);
        self::assertIsBool($res->success);
    }

    public function testLookupHlr(): void {
        $res = $this->client->lookupHlr($this->recipient);
        self::assertIsObject($res);
        self::assertIsString($res->country_code);
        self::assertIsString($res->country_name);
        self::assertIsString($res->country_prefix);
        self::assertCarrier($res->current_carrier);
        self::assertIsString($res->gsm_code);
        self::assertIsString($res->gsm_message);
        self::assertIsString($res->international_format_number);
        self::assertIsString($res->international_formatted);
        self::assertIsBool($res->lookup_outcome);
        self::assertIsString($res->lookup_outcome_message);
        self::assertIsString($res->national_format_number);
        self::assertCarrier($res->original_carrier);
        self::assertIsString($res->ported);
        self::assertIsString($res->reachable);
        self::assertIsString($res->roaming);
        self::assertIsBool($res->status);
        self::assertIsString($res->status_message);
        self::assertIsString($res->valid_number);
    }

    private static function assertCarrier(Carrier $c): void {
        self::assertIsObject($c);
        self::assertInstanceOf(Carrier::class, $c);
        self::assertIsString($c->country);
        self::assertIsString($c->name);
        self::assertIsString($c->network_code);
        self::assertIsString($c->network_type);
    }

    public function testLookupCnam(): void {
        $res = $this->client->lookupCnam($this->recipient);

        self::assertIsObject($res);
        self::assertIsString($res->code);
        self::assertIsString($res->name);
        self::assertIsString($res->number);
        self::assertIsBool($res->success);
    }
}