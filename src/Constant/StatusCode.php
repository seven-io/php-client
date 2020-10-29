<?php declare(strict_types=1);

namespace Sms77\Api\Constant;

use Sms77\Api\Library\Reflectable;

class StatusCode {
    use Reflectable;

    public const SmsCarrierTemporarilyUnavailable = 11;
    public const Sent = 100;
    public const SentPartially = 101;
    public const FromIsInvalid = 201;
    public const ToIsInvalid = 202;
    public const ToIsMissing = 301;
    public const TextIsMissing = 305;
    public const TextIsTooLong = 401;
    public const ReloadLockPrevention = 402;
    public const DailyNumberLimitReached = 403;
    public const NotEnoughCredits = 500;
    public const CarrierDeliveryFailed = 600;
    public const UnknownError = 700;
    public const AuthError = 900;
    public const HttpApiIsDisabled = 902;
    public const InvalidServerIp = 903;
}