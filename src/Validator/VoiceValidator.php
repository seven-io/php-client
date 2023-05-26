<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidBooleanOptionException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;
use Sms77\Api\Params\VoiceParamsInterface;

class VoiceValidator extends BaseValidator implements ValidatorInterface {
    public static $LANGUAGES = [
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

    /* @var VoiceParamsInterface $params */
    protected $params;

    public function __construct(VoiceParamsInterface $params) {
        $this->params = $params;

        parent::__construct((array)$this->params, ['xml']);
    }

    /**
     * @throws InvalidRequiredArgumentException
     * @throws InvalidBooleanOptionException
     */
    public function validate(): void {
        $this->from();
        $this->language();
        $this->text();
        $this->to();

        parent::validate();
    }

    public function from(): void {
        if ('' === $this->params->getFrom()) {
            $this->params->setFrom(null);
        }
    }

    /**
     * @throws InvalidRequiredArgumentException
     */
    public function language(): void {
        $language = $this->params->getLanguage();

        if ($language === null) return;

        if (!in_array($language, self::$LANGUAGES)) {
            throw new InvalidRequiredArgumentException('Invalid language.');
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function text(): void {
        $text = $this->params->getText() ?? '';

        if (null === $text || '' === $text) {
            throw new InvalidRequiredArgumentException(
                'You cannot send an empty message.');
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function to(): void {
        $to = $this->params->getTo() ?? '';

        if (null === $to || '' === $to) {
            throw new InvalidRequiredArgumentException(
                'You cannot send a message without specifying a recipient.');
        }
    }
}
