<?php

namespace Seven\Api\Resource;

use Seven\Api\BaseClient;

abstract class Resource {
    protected BaseClient $client;

    public function __construct(BaseClient $client) {
        $this->client = $client;
    }

    abstract public function validate($params): void;
}
