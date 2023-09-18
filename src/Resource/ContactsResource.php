<?php

namespace Seven\Api\Resource;

use Seven\Api\Constant\ContactsAction;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Params\ContactsParams;
use Seven\Api\Params\WriteContactParams;
use Seven\Api\Response\Contacts\Contact;
use Seven\Api\Response\Contacts\ContactCreate;
use Seven\Api\Response\Contacts\ContactDelete;
use Seven\Api\Response\Contacts\ContactEdit;
use Seven\Api\Validator\ContactsValidator;

class ContactsResource extends Resource {
    /**
     * @throws InvalidRequiredArgumentException
     */
    public function delete(int $id): ContactDelete {
        $params = (new ContactsParams(ContactsAction::DELETE))->setId($id);
        $this->validate($params);
        $res = $this->client->post('contacts', $params->toArray());

        return new ContactDelete($res);
    }

    /**
     * @param ContactsParams $params
     * @throws InvalidRequiredArgumentException
     */
    public function validate($params): void {
        (new ContactsValidator($params))->validate();
    }

    /**
     * @throws InvalidRequiredArgumentException
     */
    public function create(): ContactCreate {
        $params = new WriteContactParams;
        $this->validate($params);
        $res = $this->client->get('contacts', $params->toArray());

        return new ContactCreate($res);
    }

    /**
     * @throws InvalidRequiredArgumentException
     */
    public function write(WriteContactParams $params): ContactEdit {
        $this->validate($params);
        $res = $this->client->get('contacts', $params->toArray());

        return new ContactEdit($res);
    }

    /**
     * @return Contact[]
     * @throws InvalidRequiredArgumentException
     */
    public function read(int $id = null): array {
        $params = (new ContactsParams(ContactsAction::READ))->setId($id);
        $this->validate($params);
        $res = $this->client->get('contacts', $params->toArray());

        return array_map(static function ($value) {
            return new Contact($value);
        }, $res);
    }
}
