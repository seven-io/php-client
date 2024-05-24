<?php declare(strict_types=1);

namespace Seven\Api\Library;

enum NetworkType: string {
    case FixedLine = 'fixed_line';
    case FixedLineOrMobile = 'fixed_line_or_mobile';
    case Mobile = 'mobile';
    case Pager = 'pager';
    case PersonalNumber = 'personal_number';
    case PremiumRate = 'premium_rate';
    case SharedCost = 'shared_cost';
    case TollFree = 'toll_free';
    case Uan = 'uan';
    case Unknown = 'unknown';
    case Voicemail = 'voicemail';
    case Voip = 'voip';
}
