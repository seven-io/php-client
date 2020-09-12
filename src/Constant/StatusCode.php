<?php

namespace Sms77\Api\Constant;

use Sms77\Api\Reflectable;

class StatusCode {
    use Reflectable;

    const SmsCarrierTemporarilyUnavailable = 11;
    const Sent = 100;
    const SentPartially = 101;
    const FromIsInvalid = 201;
    const ToIsInvalid = 202;
    const ToIsMissing = 301;
    const TextIsMissing = 305;
    const TextIsTooLong = 401;
    const ReloadLockPrevention = 402;
    const DailyNumberLimitReached = 403;
    const NotEnoughCredits = 500;
    const CarrierDeliveryFailed = 600;
    const UnknownError = 700;
    const AuthError = 900;
    const HttpApiIsDisabled = 902;
    const InvalidServerIp = 903;
}