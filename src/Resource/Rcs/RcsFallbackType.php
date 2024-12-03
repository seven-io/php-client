<?php declare(strict_types=1);

namespace Seven\Api\Resource\Rcs;

enum RcsFallbackType: string
{
    case SMS = 'sms';
    case WebView = 'webview';
}
