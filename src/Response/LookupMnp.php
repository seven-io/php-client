<?php declare(strict_types=1);

namespace Seven\Api\Response;

use Seven\Api\Library\JsonObject;

/**
 * @property int code
 * @property Mnp mnp
 * @property float price
 * @property bool success
 */
class LookupMnp extends JsonObject {
    public function __construct(?object $class = null) {
        /** @var self $class */
        if ($class) {
            $class->mnp = new Mnp($class->mnp);
        }

        parent::__construct($class);
    }
}

