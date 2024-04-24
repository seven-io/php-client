<?php declare(strict_types=1);

namespace Seven\Api\Constant;

enum PaymentInterval: string
{
    case ANNUALLY = 'annually';
    case MONTHLY = 'monthly';
}
