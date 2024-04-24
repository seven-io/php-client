<?php declare(strict_types=1);

namespace Seven\Tests\Client;

use DateTime;
use Seven\Api\Library\OrderDirection;
use Seven\Api\Params\Contacts\ListParams;
use Seven\Api\Response\Contacts\Contact;
use Seven\Api\Response\Contacts\Properties;

class ContactsTest extends BaseTest
{
    public function testAll(): void
    {
        $toCreate = (new Contact)
            ->setAvatar('https://avatars.githubusercontent.com/u/37155205')
            ->setGroups([])
            ->setProperties(
                (new Properties)
                    ->setAddress('Willestr. 4-6')
                    ->setBirthday(new DateTime('01.01.2000'))
                    ->setCity('Kiel')
                    ->setEmail('support@seven.io')
                    ->setFirstname('Dan')
                    ->setHomeNumber('4943130149270')
                    ->setLastname('Developer')
                    ->setMobileNumber('4917999999999')
                    ->setNotes('CPaaS')
                    ->setPostalCode('24103')
            );
        $created = $this->client->contacts->create($toCreate);

        $this->assertEquals($toCreate->getProperties(), $created->getProperties());

        $contact = $this->client->contacts->get($created->getId());

        $this->assertEquals($created->getProperties(), $contact->getProperties());

        $listParams = (new ListParams)
            ->setLimit(77)
            ->setOffset(0)
            ->setGroupId(null)
            ->setSearch('')
            ->setOrderBy('')
            ->setOrderDirection(OrderDirection::Ascending);
        $list = $this->client->contacts->list($listParams);
        $this->assertEquals($listParams->getLimit(), $list->getPagingMetadata()->getLimit());
        $this->assertEquals($listParams->getOffset(), $list->getPagingMetadata()->getOffset());
        $match = array_filter($list->getData(), fn($entry) => $entry->getId() === $created->getId());
        $this->assertCount(1, $match);

        $toUpdate = clone $contact;
        $toUpdate->getProperties()->setNotes('New Notes');
        $updated = $this->client->contacts->update($toUpdate);
        $this->assertNotEquals($created->getProperties()->getNotes(), $updated->getProperties()->getNotes());

        $this->client->contacts->delete($created->getId());
    }
}
