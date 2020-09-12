<?php

namespace Sms77\Api\Constant;

use Sms77\Api\Reflectable;

class NetworkType {
    use Reflectable;

    const FixedLine = 'fixed_line';
    const FixedLineOrMobile = 'fixed_line_or_mobile';
    const Mobile = 'mobile';
    const Pager = 'pager';
    const PersonalNumber = 'personal_number';
    const PremiumRate = 'premium_rate';
    const SharedCost = 'shared_cost';
    const TollFree = 'toll_free';
    const Uan = 'uan';
    const Unknown = 'unknown';
    const Voicemail = 'voicemail';
    const Voip = 'voip';
}