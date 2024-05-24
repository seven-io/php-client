<?php declare(strict_types=1);

namespace Seven\Api\Library;

enum StatusCode: int {
    case SmsCarrierTemporarilyUnavailable = 11;
    case Sent = 100;
    case SentPartially = 101;
    case FromIsInvalid = 201;
    case ToIsInvalid = 202;
    case ToIsMissing = 301;
    case TextIsMissing = 305;
    case TextIsTooLong = 401;
    case ReloadLockPrevention = 402;
    case DailyNumberLimitReached = 403;
    case NotEnoughCredits = 500;
    case CarrierDeliveryFailed = 600;
    case UnknownError = 700;
    case AuthError = 900;
    case HttpApiIsDisabled = 902;
    case InvalidServerIp = 903;
}
