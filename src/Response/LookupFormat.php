<?php declare(strict_types=1);

namespace Sms77\Api\Response;

use Sms77\Api\Library\JsonObject;

/**
 * @property string carrier
 * @property string country_code
 * @property string country_iso
 * @property string country_name
 * @property string international
 * @property string international_formatted
 * @property string national
 * @property string network_type
 * @property bool success
 */
class LookupFormat extends JsonObject {
}