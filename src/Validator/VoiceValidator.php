<?php declare(strict_types=1);

namespace Seven\Api\Validator;

use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Params\VoiceParams;

class VoiceValidator {
    public static array $LANGUAGES = [
        'af-ZA',
        'am-ET',
        'ar-AE',
        'ar-BH',
        'ar-DZ',
        'ar-EG',
        'ar-IQ',
        'ar-JO',
        'ar-KW',
        'ar-LB',
        'ar-LY',
        'ar-MA',
        'ar-OM',
        'ar-QA',
        'ar-SA',
        'ar-SY',
        'ar-TN',
        'ar-YE',
        'az-AZ',
        'bg-BG',
        'bn-BD',
        'bn-IN',
        'bs-BA',
        'ca-ES',
        'cs-CZ',
        'cy-GB',
        'da-DK',
        'de-AT',
        'de-CH',
        'de-DE',
        'el-GR',
        'en-AU',
        'en-CA',
        'en-GB',
        'en-HK',
        'en-IE',
        'en-IN',
        'en-KE',
        'en-NG',
        'en-NZ',
        'en-PH',
        'en-SG',
        'en-TZ',
        'en-US',
        'en-ZA',
        'es-AR',
        'es-BO',
        'es-CL',
        'es-CO',
        'es-CR',
        'es-CU',
        'es-DO',
        'es-EC',
        'es-ES',
        'es-GQ',
        'es-GT',
        'es-HN',
        'es-MX',
        'es-NI',
        'es-PA',
        'es-PE',
        'es-PR',
        'es-PY',
        'es-SV',
        'es-US',
        'es-UY',
        'es-VE',
        'et-EE',
        'eu-ES',
        'fa-IR',
        'fi-FI',
        'fil-PH',
        'fr-BE',
        'fr-CA',
        'fr-CH',
        'fr-FR',
        'ga-IE',
        'gl-ES',
        'gu-IN',
        'he-IL',
        'hi-IN',
        'hr-HR',
        'hu-HU',
        'hy-AM',
        'id-ID',
        'is-IS',
        'it-IT',
        'ja-JP',
        'jv-ID',
        'ka-GE',
        'kk-KZ',
        'km-KH',
        'kn-IN',
        'ko-KR',
        'lo-LA',
        'lt-LT',
        'lv-LV',
        'mk-MK',
        'ml-IN',
        'mn-MN',
        'mr-IN',
        'ms-MY',
        'mt-MT',
        'my-MM',
        'nb-NO',
        'ne-NP',
        'nl-BE',
        'nl-NL',
        'pl-PL',
        'ps-AF',
        'pt-BR',
        'pt-PT',
        'ro-RO',
        'ru-RU',
        'si-LK',
        'sk-SK',
        'sl-SI',
        'so-SO',
        'sq-AL',
        'sr-RS',
        'su-ID',
        'sv-SE',
        'sw-KE',
        'sw-TZ',
        'ta-IN',
        'ta-LK',
        'ta-MY',
        'ta-SG',
        'te-IN',
        'th-TH',
        'tr-TR',
        'uk-UA',
        'ur-IN',
        'ur-PK',
        'uz-UZ',
        'vi-VN',
        'wuu-CN',
        'yue-CN',
        'zh-CN',
        'zh-HK',
        'zh-TW',
        'zu-ZA',
        'ar-EG',
        'ar-SA',
        'bg-BG',
        'ca-ES',
        'cs-CZ',
        'da-DK',
        'de-AT',
        'de-CH',
        'de-DE',
        'el-GR',
        'en-AU',
        'en-CA',
        'en-GB',
        'en-IE',
        'en-IN',
        'en-US',
        'es-ES',
        'es-MX',
        'fi-FI',
        'fr-BE',
        'fr-CA',
        'fr-CH',
        'fr-FR',
        'he-IL',
        'hi-IN',
        'hr-HR',
        'hu-HU',
        'id-ID',
        'it-IT',
        'ja-JP',
        'ko-KR',
        'ms-MY',
        'nb-NO',
        'nl-BE',
        'nl-NL',
        'pl-PL',
        'pt-BR',
        'pt-PT',
        'ro-RO',
        'ru-RU',
        'sk-SK',
        'sl-SI',
        'sv-SE',
        'ta-IN',
        'te-IN',
        'th-TH',
        'tr-TR',
        'vi-VN',
        'zh-CN',
        'zh-HK',
        'zh-TW',
    ];

    protected VoiceParams $params;

    public function __construct(VoiceParams $params) {
        $this->params = $params;
    }

    /**
     * @throws InvalidRequiredArgumentException|InvalidOptionalArgumentException
     */
    public function validate(): void {
        $this->from();
        $this->language();
        $this->ringtime();
        $this->text();
        $this->to();
    }

    /**
     * @throws InvalidOptionalArgumentException
     */
    public function from(): void {
        $from = $this->params->getFrom();

        if ($from === null) return;

        if ('' === $from) {
            $this->params->setFrom(null);
            return;
        }

        $max = 16;

        if (strlen($from) > $max) throw new InvalidOptionalArgumentException(
            "From may not exceed $max characters"
        );
    }

    /**
     * @throws InvalidRequiredArgumentException
     */
    public function language(): void {
        $language = $this->params->getLanguage();

        if ($language === null) return;

        if (!in_array($language, self::$LANGUAGES))
            throw new InvalidRequiredArgumentException('Invalid language.');
    }

    /**
     * @throws InvalidOptionalArgumentException
     */
    public function ringtime(): void {
        $ringtime = $this->params->getRingtime();

        if ($ringtime === null) return;

        $min = 1;
        $max = 60;

        if ($ringtime < $min) throw new InvalidOptionalArgumentException(
            'Ringtime may not be lower than: ' . $min
        );

        if ($ringtime > $max) throw new InvalidOptionalArgumentException(
            'Ringtime may not be higher than: ' . $max
        );
    }

    /** @throws InvalidRequiredArgumentException */
    public function text(): void {
        $text = $this->params->getText();

        $max = 10000;

        if ('' === $text)
            throw new InvalidRequiredArgumentException('You cannot send an empty message.');

        if (strlen($text) > $max)
            throw new InvalidRequiredArgumentException("Text may not exceed $max characters");
    }

    /** @throws InvalidRequiredArgumentException */
    public function to(): void {
        $to = $this->params->getTo();

        if ('' === $to) throw new InvalidRequiredArgumentException(
            'You cannot send a message without specifying a recipient.'
        );
    }
}
