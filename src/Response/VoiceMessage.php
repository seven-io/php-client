<?php declare(strict_types=1);

namespace Sms77\Api\Response;

use Sms77\Api\Library\JsonObject;

/**
 * @property string|null error
 * @property string|null error_text
 * @property int id
 * @property string[] messages
 * @property float price
 * @property string recipient
 * @property string sender
 * @property bool success
 * @property string text
 */
class VoiceMessage extends JsonObject {
    public function __construct(?object $class = null) {
        if ($class) {
            $class->id = (int)$class->id;
        }

        parent::__construct($class);
    }
}