<?php declare(strict_types=1);

namespace Sms77\Api\Response;

use Sms77\Api\Library\JsonObject;

/**
 * @property bool debug
 * @property float balance
 * @property VoiceMessage[] messages
 * @property int success
 * @property float total_price
 */
class Voice extends JsonObject {
    public function __construct(?object $class = null) {
        if ($class) {
            $class->total_price = (float)$class->total_price;
            $class->success = (int)$class->success;

            foreach ($class->messages as $k => $v) {
                $class->messages[$k] = new VoiceMessage($v);
            }
        }

        parent::__construct($class);
    }
}
