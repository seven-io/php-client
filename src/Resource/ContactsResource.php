<?php declare(strict_types=1);

namespace Seven\Api\Resource;

use Seven\Api\Params\Contacts\ListParams;
use Seven\Api\Response\Contacts\Contact;
use Seven\Api\Response\Contacts\ListContacts;

class ContactsResource extends Resource
{
    public function delete(int $id): void
    {
        $this->client->delete('contacts/' . $id);
    }

    public function validate($params): void
    {
        // TODO?
    }

    public function create(Contact $contact): Contact
    {
        return Contact::fromApi($this->client->post('contacts', $contact->toPayload()));
    }

    public function update(Contact $contact): Contact
    {
        return Contact::fromApi($this->client->patch('contacts/' . $contact->getId(), $contact->toPayload()));
    }

    public function list(ListParams $params = new ListParams): ListContacts
    {
        return new ListContacts($this->client->get('contacts', $params->toArray()));
    }

    public function get(int $id): Contact
    {
        return Contact::fromApi($this->client->get('contacts/' . $id));
    }
}
