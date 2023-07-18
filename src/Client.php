<?php declare(strict_types=1);

namespace Seven\Api;

use Seven\Api\Constant\AnalyticsConstants;
use Seven\Api\Constant\ContactsConstants;
use Seven\Api\Constant\HooksConstants;
use Seven\Api\Constant\JournalConstants;
use Seven\Api\Exception\InvalidBooleanOptionException;
use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Exception\UnexpectedApiResponseException;
use Seven\Api\Library\Util;
use Seven\Api\Params\SmsParamsInterface;
use Seven\Api\Params\VoiceParamsInterface;
use Seven\Api\Response\AbstractAnalytic;
use Seven\Api\Response\AnalyticByCountry;
use Seven\Api\Response\AnalyticByDate;
use Seven\Api\Response\AnalyticByLabel;
use Seven\Api\Response\AnalyticBySubaccount;
use Seven\Api\Response\Balance;
use Seven\Api\Response\Contact;
use Seven\Api\Response\ContactCreate;
use Seven\Api\Response\ContactDelete;
use Seven\Api\Response\ContactEdit;
use Seven\Api\Response\HookAction;
use Seven\Api\Response\Hooks;
use Seven\Api\Response\JournalBase;
use Seven\Api\Response\JournalInbound;
use Seven\Api\Response\JournalOutbound;
use Seven\Api\Response\JournalReplies;
use Seven\Api\Response\JournalVoice;
use Seven\Api\Response\LookupCnam;
use Seven\Api\Response\LookupFormat;
use Seven\Api\Response\LookupHlr;
use Seven\Api\Response\LookupMnp;
use Seven\Api\Response\Pricing;
use Seven\Api\Response\Sms;
use Seven\Api\Response\Status;
use Seven\Api\Response\ValidateForVoice;
use Seven\Api\Response\Voice;
use Seven\Api\Validator\AnalyticsValidator;
use Seven\Api\Validator\ContactsValidator;
use Seven\Api\Validator\HooksValidator;
use Seven\Api\Validator\JournalValidator;
use Seven\Api\Validator\LookupValidator;
use Seven\Api\Validator\PricingValidator;
use Seven\Api\Validator\SmsValidator;
use Seven\Api\Validator\StatusValidator;
use Seven\Api\Validator\ValidateForVoiceValidator;
use Seven\Api\Validator\VoiceValidator;
use UnexpectedValueException;

class Client extends BaseClient {
    /**
     * @param array $options
     * @return AnalyticByCountry[]
     * @throws InvalidOptionalArgumentException
     */
    public function analyticsByCountry(array $options = []): array {
        return $this->analytics($options, AnalyticsConstants::GROUP_BY_COUNTRY);
    }

    /**
     * @param array $options
     * @param string $groupBy
     * @return AbstractAnalytic[]
     * @throws InvalidOptionalArgumentException
     */
    public function analytics(
        array $options = [], string $groupBy = AnalyticsConstants::GROUP_BY_DATE): array {
        $options['group_by'] = $groupBy;

        (new AnalyticsValidator($options))->validate();

        $class = AnalyticByDate::class;
        if ($groupBy === AnalyticsConstants::GROUP_BY_COUNTRY) {
            $class = AnalyticByCountry::class;
        } elseif ($groupBy === AnalyticsConstants::GROUP_BY_LABEL) {
            $class = AnalyticByLabel::class;
        } elseif ($groupBy === AnalyticsConstants::GROUP_BY_SUBACCOUNT) {
            $class = AnalyticBySubaccount::class;
        }

        return Util::toArrayOfObject($this->get('analytics', $options), $class);
    }

    /**
     * @param array $options
     * @return AnalyticByDate[]
     * @throws InvalidOptionalArgumentException
     */
    public function analyticsByDate(array $options = []): array {
        return $this->analytics($options, AnalyticsConstants::GROUP_BY_DATE);
    }

    /**
     * @param array $options
     * @return AnalyticByLabel[]
     * @throws InvalidOptionalArgumentException
     */
    public function analyticsByLabel(array $options = []): array {
        return $this->analytics($options, AnalyticsConstants::GROUP_BY_LABEL);
    }

    /**
     * @param array $options
     * @return AnalyticBySubaccount[]
     * @throws InvalidOptionalArgumentException
     */
    public function analyticsBySubaccount(array $options = []): array {
        return $this->analytics($options, AnalyticsConstants::GROUP_BY_SUBACCOUNT);
    }

    public function balanceFloat(): float {
        return $this->balance();
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

    public function balanceJson(): Balance {
        return $this->balance(true);
    }

    /**
     * @param int $id
     * @return ContactDelete
     * @throws InvalidBooleanOptionException
     * @throws InvalidRequiredArgumentException
     */
    public function deleteContactJson(int $id): ContactDelete {
        return $this->deleteContact($id, true);
    }

    /**
     * @param int $id
     * @param bool $json
     * @return int|ContactDelete
     * @throws InvalidBooleanOptionException
     * @throws InvalidRequiredArgumentException
     */
    public function deleteContact(int $id, bool $json = false) {
        $res = $this->contacts(ContactsConstants::ACTION_DEL, ['id' => $id]);

        return $json ? new ContactDelete($res) : $res;
    }

    /**
     * @param string $action
     * @param array $options
     * @return mixed
     * @throws InvalidBooleanOptionException
     * @throws InvalidRequiredArgumentException
     */
    public function contacts(string $action, array $options = []) {
        $options['action'] = $action;

        (new ContactsValidator($options))->validate();

        $method = ContactsConstants::ACTION_DEL === $action ? 'post' : 'get';

        return $this->$method('contacts', $options);
    }

    /**
     * @param int $id
     * @return HookAction
     * @throws InvalidRequiredArgumentException
     */
    public function unsubscribeHook(int $id): HookAction {
        return new HookAction($this->hooks(HooksConstants::ACTION_UNSUBSCRIBE,
            compact('id')));
    }

    /**
     * @param string $action
     * @param array $options
     * @return mixed
     * @throws InvalidRequiredArgumentException
     */
    public function hooks(string $action, array $options = []) {
        $options['action'] = $action;

        (new HooksValidator($options))->validate();

        $method = HooksConstants::ACTION_READ === $action ? 'get' : 'post';

        return $this->$method('hooks', $options);
    }

    /**
     * @param string $target_url
     * @param string $event_type
     * @param string $request_method
     * @return HookAction
     * @throws InvalidRequiredArgumentException
     */
    public function subscribeHook(
        string $target_url,
        string $event_type,
        string $request_method = HooksConstants::REQUEST_METHOD_DEFAULT): HookAction {
        return new HookAction($this->hooks(HooksConstants::ACTION_SUBSCRIBE,
            compact('target_url', 'event_type', 'request_method')));
    }

    /** @throws InvalidRequiredArgumentException */
    public function getHooks(): Hooks {
        return new Hooks($this->hooks(HooksConstants::ACTION_READ));
    }

    /**
     * @param int $id
     * @return Contact[]
     * @throws InvalidBooleanOptionException
     * @throws InvalidRequiredArgumentException
     */
    public function getContactJson(int $id): array {
        return $this->getContact($id);
    }

    /**
     * @param int $id
     * @param bool $json
     * @return string|Contact[]
     * @throws InvalidBooleanOptionException
     * @throws InvalidRequiredArgumentException
     */
    public function getContact(int $id, bool $json = false) {
        $res = $this->contacts(
            ContactsConstants::ACTION_READ, ['json' => $json, 'id' => $id]);

        return $json ? Util::toArrayOfObject($res, Contact::class) : $res;
    }

    /**
     * @return Contact[]
     * @throws InvalidBooleanOptionException
     * @throws InvalidRequiredArgumentException
     */
    public function getContactsJson(): array {
        return $this->getContacts(true);
    }

    /**
     * @param bool $json
     * @return string|Contact[]
     * @throws InvalidBooleanOptionException
     * @throws InvalidRequiredArgumentException
     */
    public function getContacts(bool $json = false) {
        $res = $this->contacts(ContactsConstants::ACTION_READ, ['json' => $json]);

        return $json ? Util::toArrayOfObject($res, Contact::class) : $res;
    }

    /**
     * @return ContactCreate
     * @throws InvalidBooleanOptionException
     * @throws InvalidRequiredArgumentException
     */
    public function createContactJson(): ContactCreate {
        return $this->createContact(true);
    }

    /**
     * @param bool $json
     * @return string|ContactCreate
     * @throws InvalidBooleanOptionException
     * @throws InvalidRequiredArgumentException
     */
    public function createContact(bool $json = false) {
        $res = $this->contacts(ContactsConstants::ACTION_WRITE);

        return $json ? new ContactCreate($res) : $res;
    }

    /**
     * @param array $options
     * @return ContactEdit
     * @throws InvalidBooleanOptionException
     * @throws InvalidRequiredArgumentException
     */
    public function editContactJson(array $options): ContactEdit {
        return $this->editContact(array_merge($options, ['json' => 1]));
    }

    /**
     * @param array $options
     * @return int|ContactEdit
     * @throws InvalidBooleanOptionException
     * @throws InvalidRequiredArgumentException
     */
    public function editContact(array $options) {
        $res = $this->contacts(ContactsConstants::ACTION_WRITE, $options);

        return (bool)($options['json'] ?? false) ? new ContactEdit($res) : $res;
    }

    /**
     * @param array $options
     * @return JournalInbound[]
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function journalInbound(array $options = []): array {
        return $this->journal(JournalConstants::TYPE_INBOUND, $options);
    }

    /**
     * @param string $type
     * @param array $options
     * @return JournalBase[]
     * @throws InvalidOptionalArgumentException|InvalidRequiredArgumentException
     */
    public function journal(string $type, array $options = []): array {
        $options['type'] = $type;

        (new JournalValidator($options))->validate();

        switch ($type) {
            case JournalConstants::TYPE_VOICE:
                $class = JournalVoice::class;
                break;
            case JournalConstants::TYPE_OUTBOUND:
                $class = JournalOutbound::class;
                break;
            case JournalConstants::TYPE_REPLIES:
                $class = JournalReplies::class;
                break;
            default:
                $class = JournalInbound::class;
        }

        return Util::toArrayOfObject(
            $this->get(JournalConstants::ENDPOINT, $options), $class);
    }

    /**
     * @param array $options
     * @return JournalOutbound[]
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function journalOutbound(array $options = []): array {
        return $this->journal(JournalConstants::TYPE_OUTBOUND, $options);
    }

    /**
     * @param array $options
     * @return JournalReplies[]
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function journalReplies(array $options = []): array {
        return $this->journal(JournalConstants::TYPE_REPLIES, $options);
    }

    /**
     * @param array $options
     * @return JournalVoice[]
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function journalVoice(array $options = []): array {
        return $this->journal(JournalConstants::TYPE_VOICE, $options);
    }

    /**
     * @param string $number
     * @return LookupFormat
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     * @throws InvalidBooleanOptionException
     */
    public function lookupFormat(string $number): LookupFormat {
        return new LookupFormat($this->lookup('format', $number));
    }

    /**
     * @param $type
     * @param $number
     * @param array $options
     * @return mixed
     * @throws InvalidRequiredArgumentException
     * @throws InvalidOptionalArgumentException
     * @throws InvalidBooleanOptionException
     */
    public function lookup(string $type, string $number, array $options = []) {
        $options['number'] = $number;
        $options['type'] = $type;

        (new LookupValidator($options))->validate();

        return $this->post('lookup', $options);
    }

    /**
     * @param string $number
     * @return LookupCnam
     * @throws InvalidBooleanOptionException
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function lookupCnam(string $number): LookupCnam {
        return new LookupCnam($this->lookup('cnam', $number));
    }

    /**
     * @param string $number
     * @return LookupHlr
     * @throws InvalidBooleanOptionException
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function lookupHlr(string $number): LookupHlr {
        return new LookupHlr($this->lookup('hlr', $number));
    }

    /**
     * @param string $number
     * @return LookupMnp
     * @throws InvalidBooleanOptionException
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     * @throws UnexpectedApiResponseException
     */
    public function lookupMnpJson(string $number): LookupMnp {
        return $this->lookupMnp($number, true);
    }

    /**
     * @param string $number
     * @param bool $json
     * @return string|LookupMnp
     * @throws InvalidBooleanOptionException
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
     * @param string $country
     * @return string
     * @throws InvalidOptionalArgumentException
     */
    public function pricingCsv(string $country = ''): string {
        return $this->pricing(false, $country);
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
     * @param SmsParamsInterface $params
     * @return Sms
     * @throws InvalidRequiredArgumentException
     * @throws InvalidOptionalArgumentException
     * @throws InvalidBooleanOptionException
     */
    public function smsJson(SmsParamsInterface $params): Sms {
        return $this->sms($params->setJson(true));
    }

    /**
     * @param SmsParamsInterface $params
     * @return string|Sms
     * @throws InvalidRequiredArgumentException
     * @throws InvalidOptionalArgumentException
     * @throws InvalidBooleanOptionException
     */
    public function sms(SmsParamsInterface $params) {
        (new SmsValidator($params))->validate();

        $res = $this->post('sms', $params->toArray());

        return $params->getJson() ? new Sms($res) : $res;
    }

    /**
     * @param int $msgId
     * @return Status
     * @throws InvalidRequiredArgumentException
     */
    public function statusJson(int $msgId): Status {
        return $this->status($msgId, true);
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
     * @param VoiceParamsInterface $params
     * @return Voice
     * @throws InvalidBooleanOptionException
     * @throws InvalidRequiredArgumentException
     */
    public function voiceJson(VoiceParamsInterface $params): Voice {
        return $this->voice($params->setJson(true));
    }

    /**
     * @param VoiceParamsInterface $params
     * @return string|Voice
     * @throws InvalidBooleanOptionException
     * @throws InvalidRequiredArgumentException
     */
    public function voice(VoiceParamsInterface $params) {
        (new VoiceValidator($params))->validate();

        $res = $this->post('voice', $params->toArray());

        return $params->getJson() ? new Voice($res) : $res;
    }
}
