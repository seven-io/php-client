<?php declare(strict_types=1);

namespace Seven\Api\Response;

use Seven\Api\Library\JsonObject;

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
