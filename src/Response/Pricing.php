<?php declare(strict_types=1);

namespace Sms77\Api\Response;

use Sms77\Api\Library\JsonObject;

/**
 * @property int countCountries
 * @property int countNetworks
 * @property Country[] countries
 */
class Pricing extends JsonObject {
    public function __construct(?object $class = null) {
        /** @var self $class */
        if ($class) {
            foreach ($class->countries as $k => $country) {
                $class->countries[$k] = new Country($country);
            }
        }

        parent::__construct($class);
    }
}