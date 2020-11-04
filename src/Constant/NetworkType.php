<?php declare(strict_types=1);

namespace Sms77\Api\Constant;

use Sms77\Api\Library\Reflectable;

class NetworkType {
    use Reflectable;

    public const FixedLine = 'fixed_line';
    public const FixedLineOrMobile = 'fixed_line_or_mobile';
    public const Mobile = 'mobile';
    public const Pager = 'pager';
    public const PersonalNumber = 'personal_number';
    public const PremiumRate = 'premium_rate';
    public const SharedCost = 'shared_cost';
    public const TollFree = 'toll_free';
    public const Uan = 'uan';
    public const Unknown = 'unknown';
    public const Voicemail = 'voicemail';
    public const Voip = 'voip';
}