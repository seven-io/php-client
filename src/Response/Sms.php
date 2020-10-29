<?php declare(strict_types=1);

namespace Sms77\Api\Response;

use Sms77\Api\Library\JsonObject;

/**
 * @property bool debug
 * @property float balance
 * @property SmsMessage[] messages
 * @property string sms_type
 * @property int success
 * @property float total_price
 */
class Sms extends JsonObject {
    public function __construct(?object $class = null) {
        /** @var self $class */
        if ($class) {
            $class->debug = (bool)$class->debug;
            $class->success = (int)$class->success;

            foreach ($class->messages as $k => $v) {
                $class->messages[$k] = new SmsMessage($v);
            }
        }

        parent::__construct($class);
    }
}