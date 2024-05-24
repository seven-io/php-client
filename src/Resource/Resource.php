<?php declare(strict_types=1);

namespace Seven\Api\Resource;

use Seven\Api\Client;

abstract class Resource {
    public function __construct(protected Client $client) {
    }
}
