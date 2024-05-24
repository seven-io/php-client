<?php declare(strict_types=1);

namespace Seven\Api\Resource\Contacts;

use Random\RandomException;
use Seven\Api\Exception\ForbiddenIpException;
use Seven\Api\Exception\InvalidApiKeyException;
use Seven\Api\Exception\MissingAccessRightsException;
use Seven\Api\Exception\SigningHashVerificationException;
use Seven\Api\Exception\UnexpectedApiResponseException;
use Seven\Api\Resource\Resource;

class ContactsResource extends Resource {
    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     * @throws RandomException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     */
    public function delete(int $id): void {
        $this->client->delete('contacts/' . $id);
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     * @throws RandomException
     * @throws MissingAccessRightsException
     * @throws InvalidApiKeyException
     */
    public function create(Contact $contact): Contact {
        return Contact::fromApi($this->client->post('contacts', $contact->toPayload()));
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws RandomException
     * @throws UnexpectedApiResponseException
     * @throws MissingAccessRightsException
     * @throws InvalidApiKeyException
     */
    public function update(Contact $contact): Contact {
        return Contact::fromApi($this->client->patch('contacts/' . $contact->getId(), $contact->toPayload()));
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     * @throws RandomException
     * @throws MissingAccessRightsException
     * @throws InvalidApiKeyException
     */
    public function list(ListParams $params = new ListParams): ListContacts {
        return new ListContacts($this->client->get('contacts', $params->toArray()));
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     * @throws RandomException
     * @throws MissingAccessRightsException
     * @throws InvalidApiKeyException
     */
    public function get(int $id): Contact {
        return Contact::fromApi($this->client->get('contacts/' . $id));
    }
}
