<?php declare(strict_types=1);

namespace Seven\Api\Response;

use Seven\Api\Library\JsonObject;

/**
 * @property string code
 * @property string name
 * @property string number
 * @property bool success
 */
class LookupCnam extends JsonObject {
    public function __construct(?object $class = null) {
        /** @var self $class */
        if ($class) {
            $class->success = (bool)$class->success;
        }

        parent::__construct($class);
    }
}
