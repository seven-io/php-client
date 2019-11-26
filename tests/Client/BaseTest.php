<?php

namespace Sms77\Tests\Client;

use PHPUnit\Framework\TestCase;
use Sms77\Api\Client;

class BaseTest extends TestCase
{
    protected $client;
    protected $recipient;
    const SUCCESS_CODE = 100;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->client = new Client(getenv("SMS77_API_KEY"));
        $this->recipient = getenv("SMS77_RECIPIENT");
    }
}