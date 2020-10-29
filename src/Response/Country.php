<?php declare(strict_types=1);

namespace Sms77\Api\Response;

use Sms77\Api\Library\JsonObject;

/**
 * @property string countryCode
 * @property string countryName
 * @property string countryPrefix
 * @property Network[] networks
 */
class Country extends JsonObject {
    public function __construct(?object $class = null) {
        /** @var self $class */
        if ($class) {
            foreach ($class->networks as $k => $network) {
                $class->networks[$k] = new Network($network);
            }
        }

        parent::__construct($class);
    }
}