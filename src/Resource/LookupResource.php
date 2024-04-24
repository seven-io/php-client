<?php declare(strict_types=1);

namespace Seven\Api\Resource;

use Seven\Api\Response\Lookup\LookupCnam;
use Seven\Api\Response\Lookup\LookupFormat;
use Seven\Api\Response\Lookup\LookupHlr;
use Seven\Api\Response\Lookup\LookupMnp;
use Seven\Api\Response\Lookup\LookupRcsCapabilities;

class LookupResource extends Resource
{
    /**
     * @return LookupFormat[]
     */
    public function format(string ...$numbers): array
    {
        $res = $this->fetch('format', ...$numbers);
        return array_map(static fn($obj) => new LookupFormat($obj), is_array($res) ? $res : [$res]);
    }

    protected function fetch(string $type, string ...$numbers): object|array
    {
        return $this->client->get('lookup/' . $type, ['number' => implode(',', $numbers)]);
    }

    public function validate($params): void
    {
        // TODO?
    }

    /**
     * @return LookupCnam[]
     */
    public function cnam(string ...$numbers): array
    {
        $res = $this->fetch('cnam', ...$numbers);
        return array_map(static fn($obj) => new LookupCnam($obj), is_array($res) ? $res : [$res]);
    }

    /**
     * @return LookupHlr[]
     */
    public function hlr(string ...$numbers): array
    {
        $res = $this->fetch('hlr', ...$numbers);
        return array_map(static fn($obj) => new LookupHlr($obj), is_array($res) ? $res : [$res]);
    }

    /**
     * @return LookupMnp[]
     */
    public function mnp(string ...$numbers): array
    {
        $res = $this->fetch('mnp', ...$numbers);
        return array_map(static fn($obj) => new LookupMnp($obj), is_array($res) ? $res : [$res]);
    }

    /**
     * @return LookupRcsCapabilities[]
     */
    public function rcsCapabilities(string ...$numbers): array
    {
        $res = $this->fetch('rcs', ...$numbers);
        return array_map(static fn($obj) => new LookupRcsCapabilities($obj), is_array($res) ? $res : [$res]);
    }
}
