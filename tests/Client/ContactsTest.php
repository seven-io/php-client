<?php

namespace Sms77\Tests\Client;

class ContactsTest extends BaseTest
{
    function testContactsCsv()
    {
        $contacts = $this->client->contacts("read");

        $contacts = explode(PHP_EOL, $contacts);

        $this->assertIsArray($contacts);
    }

    function testContactsJson()
    {
        $contacts = $this->client->contacts("read", ["json" => true]);

        $contacts = json_decode($contacts);

        $this->assertIsArray($contacts);
    }
}