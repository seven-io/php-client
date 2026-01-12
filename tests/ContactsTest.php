<?php declare(strict_types=1);

namespace Seven\Tests;

use DateTime;
use Seven\Api\Library\OrderDirection;
use Seven\Api\Resource\Contacts\Contact;
use Seven\Api\Resource\Contacts\ListParams;
use Seven\Api\Resource\Contacts\Properties;

class ContactsTest extends AbstractTestCase {
    public function testAll(): void {
        $toCreate = (new Contact)
            ->setAvatar('https://avatars.githubusercontent.com/u/37155205')
            ->setGroups([])
            ->setProperties(
                (new Properties)
                    ->setAddress('Willestr. 4-6')
                    ->setBirthday(new DateTime('2000-01-01'))
                    ->setCity('Kiel')
                    ->setEmail('support@seven.io')
                    ->setFirstname('Dan')
                    ->setHomeNumber('4943130149270')
                    ->setLastname('Developer')
                    ->setMobileNumber('4917999999999')
                    ->setNotes('CPaaS')
                    ->setPostalCode('24103')
            );
        $created = $this->resources->contacts->create($toCreate);

        $this->assertEquals($toCreate->getProperties(), $created->getProperties());

        $contact = $this->resources->contacts->get($created->getId());

        $this->assertEquals($created->getProperties(), $contact->getProperties());

        $listParams = (new ListParams)
            ->setLimit(10)
            ->setOffset(0);
        $list = $this->resources->contacts->list($listParams);
        $this->assertEquals($listParams->getLimit(), $list->getPagingMetadata()->getLimit());
        $this->assertEquals($listParams->getOffset(), $list->getPagingMetadata()->getOffset());
        $this->assertGreaterThan(0, count($list->getData()));

        $toUpdate = clone $contact;
        $toUpdate->getProperties()->setNotes('New Notes');
        $updated = $this->resources->contacts->update($toUpdate);
        $this->assertNotEquals($created->getProperties()->getNotes(), $updated->getProperties()->getNotes());

        $this->resources->contacts->delete($created->getId());
    }
}
