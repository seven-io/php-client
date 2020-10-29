<?php declare(strict_types=1);

namespace Sms77\Tests\Client;

use Sms77\Api\Response\Contact;
use Sms77\Api\Response\ContactCreate;
use Sms77\Api\Response\ContactDelete;

class ContactsTest extends BaseTest {
    public function testContactsReadCsv(): void {
        $res = $this->client->getContacts();
        $res = explode(PHP_EOL, $res);

        self::assertIsArray($res);

        if (count($res)) {
            $c0 = self::toJSON(reset($res));
            self::assertContact($c0);

            self::assertContact(self::toJSON($this->client->getContact($c0->ID)));
        }
    }

    private static function toJSON(string $csv): Contact {
        $c = str_replace('"', '', $csv);
        [$id, $name, $number] = explode(';', $c);

        $c = new Contact;
        $c->Name = $name;
        $c->Number = $number;
        $c->setID($id);

        return $c;
    }

    private static function assertContact(Contact $c): void {
        self::assertIsInt($c->ID);

        self::assertIsString($c->Name);

        self::assertIsString($c->Number);
    }

    public function testContactsReadJson(): void {
        /** @var Contact[] $res */
        $res = $this->client->getContacts(true);

        self::assertIsArray($res);

        if (count($res)) {
            self::assertRead($res);

            self::assertRead($this->client->getContact(reset($res)->ID, true));
        }
    }

    private static function assertRead(array $res): void {
        self::assertContact(reset($res));
    }

    public function testContactsCreateEditDelete(): void {
        $c = new ContactCreate($this->client->createContact());

        self::assertCreate($c);

        self::assertWriteSuccess($this->client->editContact([
            'email' => 'Tommy_Testersen@web.de',
            'empfaenger' => '+0123459877676',
            'id' => $c->id,
            'nick' => 'Tommy Testersen',
        ]));

        self::assertRead($this->client->getContact($c->id, true));

        self::assertWriteSuccess($this->client->deleteContact($c->id));
    }

    private static function assertCreate(ContactCreate $c): void {
        self::assertIsInt($c->id);
        self::assertGreaterThan(0, $c->id);
        self::assertEquals(152, $c->code);
    }

    private static function assertWriteSuccess(int $code): void {
        self::assertEquals(152, $code);
    }

    public function testContactsCreateDeleteJson(): void {
        $res = $this->client->createContact(true);
        self::assertCreate($res);

        $res = $this->client->deleteContact($res->id, true);
        self::assertInstanceOf(ContactDelete::class, $res);
        self::assertWriteSuccess($res->code);
    }
}