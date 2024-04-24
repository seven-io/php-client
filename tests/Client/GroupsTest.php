<?php declare(strict_types=1);

namespace Seven\Tests\Client;

use Seven\Api\Params\Groups\ListParams;

class GroupsTest extends BaseTest
{
    public function testAll(): void
    {
        $name = 'PHP Test Group';
        $created = $this->client->groups->create($name);

        $this->assertEquals($name, $created->getName());

        $group = $this->client->groups->get($created->getId());

        $this->assertEquals($created, $group);

        $listParams = new ListParams();
        $listParams->setLimit(77);
        $listParams->setOffset(0);
        $list = $this->client->groups->list($listParams);
        //$this->assertEquals($listParams->getLimit(), $list->getPagingMetadata()->getLimit());
        $this->assertEquals($listParams->getOffset(), $list->getPagingMetadata()->getOffset());
        $match = array_filter($list->getData(), fn($entry) => $entry->getId() === $created->getId());
        $this->assertCount(1, $match);

        $newName = 'PHP Test Group With a new Name';
        $updated = $this->client->groups->update($created->getId(), $newName);
        $this->assertNotEquals($created->getName(), $updated->getName());

        $deleted = $this->client->groups->delete($created->getId());
        $this->assertTrue($deleted->getSuccess());
    }
}
