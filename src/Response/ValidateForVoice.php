<?php declare(strict_types=1);

namespace Sms77\Api\Response;

use Sms77\Api\Library\JsonObject;

/**
 * @property int code
 * @property string|null error
 * @property string|null formatted_output
 * @property int id
 * @property string sender
 * @property bool success
 * @property bool voice
 */
class ValidateForVoice extends JsonObject {
    public function __construct(?object $class = null) {
        /** @var self $class */
        if ($class && property_exists($class, 'code')) {
            $class->code = (int)$class->code;
        }

        parent::__construct($class);
    }
}