<?php declare(strict_types=1);

namespace Seven\Api\Resource\Groups;

use Random\RandomException;
use Seven\Api\Exception\ForbiddenIpException;
use Seven\Api\Exception\InvalidApiKeyException;
use Seven\Api\Exception\MissingAccessRightsException;
use Seven\Api\Exception\SigningHashVerificationException;
use Seven\Api\Exception\UnexpectedApiResponseException;
use Seven\Api\Resource\Resource;

class GroupsResource extends Resource {
    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     * @throws RandomException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     */
    public function delete(int $id, bool $deleteContacts = false): GroupDelete {
        $path = 'groups/' . $id;
        if ($deleteContacts) $path .= '?delete_contacts=true';

        return new GroupDelete($this->client->delete($path));
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     * @throws RandomException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     */
    public function create(string $name): Group {
        return new Group($this->client->post('groups', compact('name')));
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws RandomException
     * @throws UnexpectedApiResponseException
     * @throws MissingAccessRightsException
     * @throws InvalidApiKeyException
     */
    public function update(int $id, string $name): Group {
        return new Group($this->client->patch('groups/' . $id, compact('name')));
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws RandomException
     * @throws UnexpectedApiResponseException
     * @throws MissingAccessRightsException
     * @throws InvalidApiKeyException
     */
    public function list(ListParams $params = new ListParams): ListGroups {
        return new ListGroups($this->client->get('groups', $params->toArray()));
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws RandomException
     * @throws UnexpectedApiResponseException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     */
    public function get(int $id): Group {
        return new Group($this->client->get('groups/' . $id));
    }
}
