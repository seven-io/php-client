<?php declare(strict_types=1);

namespace Sms77\Api\Response;

use Sms77\Api\Library\JsonObject;

/**
 * @property string date may be missing depending on "group_by" argument
 * @property string country may be missing depending on "group_by" argument
 * @property string account may be missing depending on "group_by" argument
 * @property string label may be missing depending on "group_by" argument
 * @property int economy
 * @property int direct
 * @property int hlr
 * @property int inbound
 * @property int mnp
 * @property float usage_eur
 * @property int voice
 */
class Analytic extends JsonObject {
}