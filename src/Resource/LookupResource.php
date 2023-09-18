<?php

namespace Seven\Api\Resource;

use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Params\LookupParams;
use Seven\Api\Response\Lookup\LookupCnam;
use Seven\Api\Response\Lookup\LookupFormat;
use Seven\Api\Response\Lookup\LookupHlr;
use Seven\Api\Response\Lookup\LookupMnp;
use Seven\Api\Validator\LookupValidator;

class LookupResource extends Resource {
    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function format(string ...$numbers): LookupFormat {
        $params = new LookupParams('format', ...$numbers);
        $res = $this->fetch($params);
        return new LookupFormat($res);
    }

    /**
     * @return mixed
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    protected function fetch(LookupParams $params) {
        $this->validate($params);

        return $this->client->post('lookup', $params->toArray());
    }

    /**
     * @param LookupParams $params
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function validate($params): void {
        (new LookupValidator($params))->validate();
    }

    /**
     * @return LookupCnam[]
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function cnam(string ...$numbers): array {
        $params = new LookupParams('cnam', ...$numbers);
        $res = $this->fetch($params);

        return array_map(static function ($obj) {
            return new LookupCnam($obj);
        }, is_array($res) ? $res : [$res]);
    }

    /**
     * @return LookupHlr[]
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function hlr(string ...$numbers): array {
        $params = new LookupParams('hlr', ...$numbers);
        $res = $this->fetch($params);

        return array_map(static function ($obj) {
            return new LookupHlr($obj);
        }, is_array($res) ? $res : [$res]);
    }

    /**
     * @return LookupMnp[]
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function mnp(string ...$numbers): array {
        $params = (new LookupParams('mnp', ...$numbers))->setJson(true);
        $res = $this->fetch($params);

        return array_map(static function ($obj) {
            return new LookupMnp($obj);
        }, is_array($res) ? $res : [$res]);
    }
}
