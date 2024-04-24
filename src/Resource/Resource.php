<?php declare(strict_types=1);

namespace Seven\Api\Resource;

use Seven\Api\BaseClient;

abstract class Resource
{
    public function __construct(protected BaseClient $client)
    {
    }

    abstract public function validate($params): void;
}
