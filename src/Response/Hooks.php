<?php declare(strict_types=1);

namespace Seven\Api\Response;

use Seven\Api\Library\JsonObject;

/**
 * @property bool success
 * @property Hook[] hooks
 */
class Hooks extends JsonObject {
    public function __construct(?object $class = null) {
        /** @var self $class */
        if ($class) {
            foreach ($class->hooks as $k => $v) {
                $class->hooks[$k] = new Hook($v);
            }
        }

        parent::__construct($class);
    }
}
