<?php declare(strict_types=1);

namespace Sms77\Api\Response;

use Sms77\Api\Library\JsonObject;

/**
 * @property int ID
 * @property string Name
 * @property string Number
 */
class Contact extends JsonObject {
    public function __construct(?object $class = null) {
        /** @var self $class */
        $class && $class->ID = (int)$class->ID;

        parent::__construct($class);
    }

    public function setID($id): void {
        $this->ID = (int)$id;
    }
}