<?php declare(strict_types=1);

namespace Seven\Api\Resource;

use Seven\Api\Params\Groups\ListParams;
use Seven\Api\Response\Groups\Group;
use Seven\Api\Response\Groups\GroupDelete;
use Seven\Api\Response\Groups\ListGroups;

class GroupsResource extends Resource
{
    public function delete(int $id, bool $deleteContacts = false): GroupDelete
    {
        $path = 'groups/' . $id;
        if ($deleteContacts) $path .= '?delete_contacts=true';

        return new GroupDelete($this->client->delete($path));
    }

    public function create(string $name): Group
    {
        return new Group($this->client->post('groups', compact('name')));
    }

    public function update(int $id, string $name): Group
    {
        return new Group($this->client->patch('groups/' . $id, compact('name')));
    }

    public function validate($params): void
    {
        // TODO?
    }

    public function list(ListParams $params = new ListParams): ListGroups
    {
        return new ListGroups($this->client->get('groups', $params->toArray()));
    }

    public function get(int $id): Group
    {
        return new Group($this->client->get('groups/' . $id));
    }
}
