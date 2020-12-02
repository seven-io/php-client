<?php declare(strict_types=1);

namespace Sms77\Api\Response;

use Sms77\Api\Library\JsonObject;

/**
 * @property string from
 * @property string id
 * @property string price
 * @property string text
 * @property string timestamp
 * @property string to
 */
abstract class JournalBase extends JsonObject {
}