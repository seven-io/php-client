<?php declare(strict_types=1);

namespace Seven\Tests\Client;

use Seven\Api\Params\WriteContactParams;
use Seven\Api\Response\Contacts\Contact;
use Seven\Api\Response\Contacts\ContactCreate;
use Seven\Api\Response\Contacts\ContactDelete;

class ContactsTest extends BaseTest {
    public function testContactsRead(): void {
        $res = $this->client->contacts->read();

        $this->assertIsArray($res);

        if (count($res)) {
            $this->assertRead($res);
            $contact = reset($res);
            $contact = $this->client->contacts->read($contact->getId());
            $this->assertRead($contact);
        }
    }

    private function assertRead(array $res): void {
        $this->assertContact(reset($res));
    }

    private function assertContact(Contact $c): void {
        $this->assertGreaterThanOrEqual(1, $c->getId());
    }

    public function testContactsCreateEditDelete(): void {
        $c = $this->client->contacts->create();
        $contactId = $c->getId();

        $this->assertCreate($c);

        $writeParams = (new WriteContactParams)
            ->setEmail('Tommy_Testersen@web.de')
            ->setId($contactId)
            ->setMobile('+0123459877676')
            ->setNick('Tommy Testersen');
        $writeResponse = $this->client->contacts->write($writeParams);
        $this->assertEquals(152, $writeResponse->getReturn());

        $this->assertRead($this->client->contacts->read($contactId));

        $this->assertDeleteSuccess($this->client->contacts->delete($contactId));
    }

    private function assertCreate(ContactCreate $c): void {
        $contactId = $c->getId();

        $this->assertIsInt($contactId);
        $this->assertGreaterThan(0, $contactId);
        $this->assertEquals(152, $c->getCode());
    }

    private function assertDeleteSuccess(ContactDelete $contactDelete): void {
        $this->assertEquals(152, $contactDelete->getCode());
    }

    public function testContactsCreateDelete(): void {
        $res = $this->client->contacts->create();
        $this->assertCreate($res);

        $res = $this->client->contacts->delete($res->getId());
        $this->assertDeleteSuccess($res);
    }
}
