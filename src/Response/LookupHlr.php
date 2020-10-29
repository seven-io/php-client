<?php declare(strict_types=1);

namespace Sms77\Api\Response;

use Sms77\Api\Library\JsonObject;

/**
 * @property string country_code
 * @property string country_name
 * @property string country_prefix
 * @property Carrier current_carrier
 * @property string gsm_code
 * @property string gsm_message
 * @property string international_format_number
 * @property string international_formatted
 * @property bool lookup_outcome
 * @property string lookup_outcome_message
 * @property string national_format_number
 * @property Carrier original_carrier
 * @property string ported
 * @property string reachable
 * @property string roaming
 * @property bool status
 * @property string status_message
 * @property string valid_number
 */
class LookupHlr extends JsonObject {
    public function __construct(?object $class = null) {
        /** @var self $class */
        if ($class) {
            $class->current_carrier = new Carrier($class->current_carrier);
            $class->original_carrier = new Carrier($class->original_carrier);
        }

        parent::__construct($class);
    }
}