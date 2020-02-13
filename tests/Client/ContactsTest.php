<?php

namespace Sms77\Tests\Client;

class ContactsTest extends BaseTest
{
    public function testContactsCsv()
    {
        $contacts = $this->client->contacts('read');

        $contacts = explode(PHP_EOL, $contacts);

        $this->assertTrue(is_array($contacts));
    }

    public function testContactsJson()
    {
        $contacts = $this->client->contacts('read', ['json' => true]);

        $contacts = json_decode($contacts, false);

        $this->assertTrue(is_array($contacts));
    }
}