<?php declare(strict_types=1);

namespace Sms77\Api\Response;

use Sms77\Api\Library\JsonObject;

/**
 * @property int economy
 * @property int direct
 * @property int hlr
 * @property int inbound
 * @property int mnp
 * @property float usage_eur
 * @property int voice
 */
abstract class AbstractAnalytic extends JsonObject {
}