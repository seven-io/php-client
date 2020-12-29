<?php declare(strict_types=1);

namespace Sms77\Api\Response;

use Sms77\Api\Library\JsonObject;

/**
 * @property int id
 * @property string target_url
 * @property string event_type
 * @property string request_method
 * @property string created
 */
class Hook extends JsonObject {
    public function __construct(?object $class = null) {
        /** @var self $class */
        if ($class) {
            $class->id = (int)$class->id;
        }

        parent::__construct($class);
    }
}