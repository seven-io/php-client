<?php declare(strict_types=1);

namespace Sms77\Tests\Client;

use PHPUnit\Framework\TestCase;
use Sms77\Api\Client;

abstract class BaseTest extends TestCase {
    protected $client;
    protected $recipient;

    public function __construct(
        ?string $name = null, array $data = [], string $dataName = '') {
        parent::__construct($name, $data, $dataName);

        $this->client = new Client(getenv('SMS77_API_KEY'), 'php-api-test');

        $this->recipient = getenv('SMS77_RECIPIENT') ?? '+491771783130';
    }
}