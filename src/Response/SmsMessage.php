<?php declare(strict_types=1);

namespace Sms77\Api\Response;

use Sms77\Api\Library\JsonObject;

/**
 * @property string encoding
 * @property string|null error
 * @property string|null error_text
 * @property string|null id
 * @property string[] messages
 * @property int parts
 * @property float price
 * @property string recipient
 * @property string sender
 * @property bool success
 * @property string text
 */
class SmsMessage extends JsonObject {
    public function __construct(?object $class = null) {
        /** @var self $class */
        if ($class) {
            $class->id = (int)$class->id;
        }

        parent::__construct($class);
    }
}