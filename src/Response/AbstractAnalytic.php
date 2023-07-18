<?php declare(strict_types=1);

namespace Seven\Api\Response;

use Seven\Api\Library\JsonObject;

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
