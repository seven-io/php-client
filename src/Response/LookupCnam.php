<?php declare(strict_types=1);

namespace Sms77\Api\Response;

use Sms77\Api\Library\JsonObject;

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