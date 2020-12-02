<?php declare(strict_types=1);

namespace Sms77\Api\Response;

/**
 * @property string connection
 * @property string|null dlr
 * @property string|null dlr_timestamp
 * @property string|null foreign_id
 * @property string|null label
 * @property string|null latency
 * @property string|null mccmnc
 * @property string type
 */
class JournalOutbound extends JournalBase {}