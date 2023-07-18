<?php declare(strict_types=1);

namespace Seven\Api\Response;

use Seven\Api\Library\JsonObject;

/**
 * @property int ID
 * @property string Name
 * @property string Number
 */
class Contact extends JsonObject {
    public function __construct(?object $class = null) {
        /** @var self $class */
        if ($class) {
            $class->ID = (int)$class->ID;
        }

        parent::__construct($class);
    }

    public function setID($id): void {
        $this->ID = (int)$id;
    }
}
