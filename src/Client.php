<?php declare(strict_types=1);

namespace Sms77\Api;

use Sms77\Api\Constant\ContactsConstants;
use Sms77\Api\Constant\HooksConstants;
use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;
use Sms77\Api\Exception\UnexpectedApiResponseException;
use Sms77\Api\Library\Util;
use Sms77\Api\Response\Analytic;
use Sms77\Api\Response\Balance;
use Sms77\Api\Response\Contact;
use Sms77\Api\Response\ContactCreate;
use Sms77\Api\Response\ContactDelete;
use Sms77\Api\Response\ContactEdit;
use Sms77\Api\Response\LookupCnam;
use Sms77\Api\Response\LookupFormat;
use Sms77\Api\Response\LookupHlr;
use Sms77\Api\Response\LookupMnp;
use Sms77\Api\Response\Pricing;
use Sms77\Api\Response\Sms;
use Sms77\Api\Response\Status;
use Sms77\Api\Response\ValidateForVoice;
use Sms77\Api\Response\Voice;
use Sms77\Api\Response\WebhookAction;
use Sms77\Api\Response\Webhooks;
use Sms77\Api\Validator\AnalyticsValidator;
use Sms77\Api\Validator\ContactsValidator;
use Sms77\Api\Validator\HooksValidator;
use Sms77\Api\Validator\LookupValidator;
use Sms77\Api\Validator\PricingValidator;
use Sms77\Api\Validator\SmsValidator;
use Sms77\Api\Validator\StatusValidator;
use Sms77\Api\Validator\ValidateForVoiceValidator;
use Sms77\Api\Validator\VoiceValidator;
use UnexpectedValueException;

class Client extends BaseClient {
    /**
     * @param array $options
     * @return Analytic[]
     * @throws InvalidOptionalArgumentException
     */
    public function analytics(array $options = []): array {
        (new AnalyticsValidator($options))->validate();

        return Util::toArrayOfObject($this->get('analytics', $options), Analytic::class);
    }

    /**
     * @param bool $json
     * @return float|Balance
     */
    public function balance(bool $json = false) {
        $res = $this->get('balance');

        if (!is_float($res)) {
            $type = gettype($res);
            throw new UnexpectedValueException(
                "Expected type float, but received type $type for response $res.");
        }

        return $json ? new Balance($res) : $res;
    }

    /**
     * @param int $id
     * @param bool $json
     * @return int|ContactDelete
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function deleteContact(int $id, bool $json = false) {
        $res = $this->contacts(ContactsConstants::ACTION_DEL, ['id' => $id]);

        return $json ? new ContactDelete($res) : $res;
    }

    /**
     * @param $action
     * @param array $options
     * @return mixed
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    private function contacts(string $action, array $options = []) {
        $options['action'] = $action;

        (new ContactsValidator($options))->validate();

        $method = ContactsConstants::ACTION_DEL === $action ? 'post' : 'get';

        return $this->$method('contacts', $options);
    }

    /**
     * @param int|null $id
     * @param string|null $target_url
     * @param string|null $event_type
     * @param string|null $request_method
     * @return WebhookAction
     * @throws InvalidRequiredArgumentException
     */
    public function unsubscribeWebhook(
        ?int $id,
        ?string $target_url = null,
        ?string $event_type = null,
        ?string $request_method = null): WebhookAction {
        return new WebhookAction($this->hooks(HooksConstants::ACTION_UNSUBSCRIBE,
            compact('id', 'target_url', 'event_type', 'request_method')));
    }

    /**
     * @param string $action
     * @param array $options
     * @return mixed
     * @throws InvalidRequiredArgumentException
     */
    private function hooks(string $action, array $options = []) {
        $options['action'] = $action;

        (new HooksValidator($options))->validate();

        $method = HooksConstants::ACTION_READ === $action ? 'get' : 'post';

        return $this->$method('hooks', $options);
    }

    /**
     * @param string $target_url
     * @param string $event_type
     * @param string $request_method
     * @return WebhookAction
     * @throws InvalidRequiredArgumentException
     */
    public function subscribeWebhook(
        string $target_url,
        string $event_type,
        string $request_method = HooksConstants::REQUEST_METHOD_DEFAULT): WebhookAction {
        return new WebhookAction($this->hooks(HooksConstants::ACTION_SUBSCRIBE,
            compact('target_url', 'event_type', 'request_method')));
    }

    /** @throws InvalidRequiredArgumentException */
    public function getWebhooks(): Webhooks {
        return new Webhooks($this->hooks(HooksConstants::ACTION_READ));
    }

    /**
     * @param bool $json
     * @return string|Contact[]
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function getContacts(bool $json = false) {
        $res = $this->contacts(ContactsConstants::ACTION_READ, ['json' => $json]);

        return $json ? Util::toArrayOfObject($res, Contact::class) : $res;
    }

    /**
     * @param int $id
     * @param bool $json
     * @return string|Contact[]
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function getContact(int $id, bool $json = false) {
        $res = $this->contacts(
            ContactsConstants::ACTION_READ, ['json' => $json, 'id' => $id]);

        return $json ? Util::toArrayOfObject($res, Contact::class) : $res;
    }

    /**
     * @param bool $json
     * @return string|ContactCreate
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function createContact(bool $json = false) {
        $res = $this->contacts(ContactsConstants::ACTION_WRITE);

        return $json ? new ContactCreate($res) : $res;
    }

    /**
     * @param array $options
     * @return int|ContactEdit
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function editContact(array $options = []) {
        $res = $this->contacts(ContactsConstants::ACTION_WRITE, $options);

        return (bool)($options['json'] ?? false) ? new ContactEdit($res) : $res;
    }

    /**
     * @param string $number
     * @return LookupFormat
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function lookupFormat(string $number): LookupFormat {
        return new LookupFormat($this->lookup('format', $number));
    }

    /**
     * @param $type
     * @param $number
     * @param array $options
     * @return mixed
     * @throws InvalidRequiredArgumentException|InvalidOptionalArgumentException
     */
    private function lookup(string $type, string $number, array $options = []) {
        $options['number'] = $number;
        $options['type'] = $type;

        (new LookupValidator($options))->validate();

        return $this->post('lookup', $options);
    }

    /**
     * @param string $number
     * @return LookupCnam
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function lookupCnam(string $number): LookupCnam {
        return new LookupCnam($this->lookup('cnam', $number));
    }

    /**
     * @param string $number
     * @return LookupHlr
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function lookupHlr(string $number): LookupHlr {
        return new LookupHlr($this->lookup('hlr', $number));
    }

    /**
     * @param string $number
     * @param bool $json
     * @return string|LookupMnp
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     * @throws UnexpectedApiResponseException
     */
    public function lookupMnp(string $number, bool $json = false) {
        $res = $this->lookup('mnp', $number, $json ? ['json' => true] : []);

        if ($json) {
            $type = gettype($res);

            if ('object' !== $type) {
                throw new UnexpectedApiResponseException(
                    "Expected object, but received $type with value $res");
            }

            return new LookupMnp($res);
        }

        if (!LookupValidator::isValidMobileNetworkShortName($res)) {
            throw new UnexpectedApiResponseException(
                "Expected a valid provider value, but received $res instead");
        }

        return $res;
    }

    /**
     * @param bool $json
     * @param string $country
     * @return string|Pricing
     * @throws InvalidOptionalArgumentException
     */
    public function pricing(bool $json = true, string $country = '') {
        $options = ['format' => $json ? 'json' : 'csv', 'country' => $country];

        (new PricingValidator($options))->validate();

        $res = $this->get('pricing', $options);

        return $json ? new Pricing($res) : $res;
    }

    /**
     * @param string $to
     * @param string $text
     * @param array $options
     * @return string|Sms
     * @throws InvalidRequiredArgumentException|InvalidOptionalArgumentException
     */
    public function sms(string $to, string $text, array $options = []) {
        $options['to'] = $to;
        $options['text'] = $text;

        (new SmsValidator($options))->validate();

        $res = $this->post('sms', $options);

        return (bool)($options['json'] ?? false) ? new Sms($res) : $res;
    }

    /**
     * @param int $msgId
     * @param bool $json
     * @return string|Status
     * @throws InvalidRequiredArgumentException
     */
    public function status(int $msgId, bool $json = false) {
        $options = ['msg_id' => $msgId];

        (new StatusValidator($options))->validate();

        $res = $this->get('status', $options);

        return $json ? new Status($res) : $res;
    }

    /**
     * @param string $number
     * @param array $opts
     * @return ValidateForVoice
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function validateForVoice(string $number, array $opts = []): ValidateForVoice {
        $opts['number'] = $number;

        (new ValidateForVoiceValidator($opts))->validate();

        return new ValidateForVoice($this->post('validate_for_voice', $opts));
    }

    /**
     * @param string $to
     * @param string $text
     * @param bool $xml
     * @param bool $json
     * @return string|Voice
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function voice(
        string $to, string $text, bool $xml = false, bool $json = false) {
        $options = [
            'text' => $text,
            'to' => $to,
            'xml' => $xml,
        ];

        (new VoiceValidator($options))->validate();

        $res = $this->post('voice', $options);

        return $json ? new Voice($res) : $res;
    }
}