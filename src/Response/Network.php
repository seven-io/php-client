<?php declare(strict_types=1);

namespace Sms77\Api\Response;

use Sms77\Api\Library\JsonObject;

/**
 * @property string mcc
 * @property string[] mncs
 * @property string networkName
 * @property float price
 * @property string[] features
 * @property string comment
 */
class Network extends JsonObject {
}