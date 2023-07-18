<?php declare(strict_types=1);

namespace Seven\Api\Response;

use Seven\Api\Library\JsonObject;

/**
 * @property int return
 */
class ContactEdit extends JsonObject {
    public function __construct(?object $class = null) {
        /** @var self $class */
        if ($class) {
            $class->return = (int)$class->return;
        }

        parent::__construct($class);
    }
}
