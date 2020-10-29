<?php declare(strict_types=1);

namespace Sms77\Api\Response;

use Sms77\Api\Library\JsonObject;

/**
 * @property string country
 * @property string international_formatted
 * @property bool isPorted
 * @property string mccmnc
 * @property string national_format
 * @property string network
 * @property string number
 */
class Mnp extends JsonObject {
}