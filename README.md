![](https://www.seven.io/wp-content/uploads/Logo.svg "seven Logo")

# Official PHP API Client

## Installation

**Via Composer:**

```shell script 
composer require sms77/api 
```

Alternatively you
can [download as *.ZIP](https://github.com/seven-io/php-client/releases/latest "download as *.ZIP")
if you don't use Composer.

### Usage

```php
use Sms77\Api\Client;
use Sms77\Api\Params\SmsParams;
$client = new Client('MY_VERY_SECRET_API_KEY!');
$params = new SmsParams();
$client->sms($params
    ->setTo('+4901234567890')
    ->setText('HI2U'));
```

#### Methods

<details>
<summary>Analytics</summary>

<ul>
    <li>analytics(array options = [], string $groupBy = 'date'): AbstractAnalytic[]</li>
    <li>analyticsByCountry(array options = []): AnalyticByCountry[]</li>
    <li>analyticsByDate(array options = []): AnalyticByDate[]</li>
    <li>analyticsByLabel(array options = []): AnalyticByLabel[]</li>
    <li>analyticsBySubaccount(array options = []): AnalyticBySubaccount[]</li>
</ul>
</details>

<details>
<summary>Balance</summary>

<ul>
    <li>balance(bool $json = false): float|Balance</li>
    <li>balanceFloat(): float</li>
    <li>balanceJson(): Balance</li>
</ul>
</details>

<details>
<summary>Contacts</summary>

<ul>
    <li>contacts(string $action, array $options = []): mixed</li>
    <li>createContact(bool $json = false): string|ContactCreate</li>
    <li>createContactJson(): ContactCreate</li>
    <li>deleteContact(int $id, bool $json = false): int|ContactDelete</li>
    <li>deleteContactJson(int $id): ContactDelete</li>
    <li>editContact(array $options): int|ContactEdit</li>
    <li>editContactJson(array $options): ContactEdit</li>
    <li>getContact(int $id, bool $json = false): string|Contact[]</li>
    <li>getContactJson(int $id): Contact[]</li>
    <li>getContacts(bool $json = false): string|Contact[]</li>
    <li>getContactsJson(): Contact[]</li>
</ul>
</details>

<details>
<summary>Hooks</summary>

<ul>
    <li>hooks(string $action, array $options = []): mixed</li>
    <li>getHooks(): Hooks</li>
    <li>subscribeHook(string $target_url, string $event_type, string $request_method = HooksConstants::REQUEST_METHOD_DEFAULT): HookAction</li>
    <li>unsubscribeHook(?int $id, ?string $target_url = null, ?string $event_type = null, ?string $request_method = null): HookAction</li>
</ul>
</details>

<details>
<summary>Journal</summary>

<ul>
    <li>journal(string $type, array $options = []): JournalBase[]</li>
    <li>journalInbound(array $options = []): JournalInbound[]</li>
    <li>journalOutbound(array $options = []): JournalOutbound[]</li>
    <li>journalReplies(array $options = []): JournalReplies[]</li>
    <li>journalVoice(array $options = []): JournalVoice[]</li>
</ul>
</details>

<details>
<summary>Lookup</summary>

<ul>
    <li>lookup(string $type, string $number, array $options = []): mixed</li>
    <li>lookupFormat(string $number): LookupFormat</li>
    <li>lookupCnam(string $number): LookupCnam</li>
    <li>lookupHlr(string $number): LookupHlr</li>
    <li>lookupMnp(string $number, bool $json = false): string|LookupMnp</li>
    <li>lookupMnpJson(string $number): LookupMnp</li>
</ul>
</details>

<details>
<summary>Pricing</summary>

<ul>
    <li>pricing(bool $json = true, string $country = ''): string|Pricing</li>
    <li>pricingCsv(string $country = ''): string</li>
</ul>
</details>

<details>
<summary>SMS</summary>

<ul>
    <li>sms(SmsParamsInterface $params): string|Sms</li>
    <li>smsJson(SmsParamsInterface $params): Sms</li>
</ul>
</details>

<details>
<summary>Status</summary>

<ul>
    <li>status(int $msgId, bool $json = false): string|Status</li>
    <li>statusJson(int $msgId): Status</li>
</ul>
</details>

<details>
<summary>Validate for Voice</summary>

<ul>
    <li>validateForVoice(string $number, array $opts = []): ValidateForVoice</li>
</ul>
</details>

<details>
<summary>Voice</summary>

<ul>
    <li>voice(VoiceParamsInterface $p): string|Voice</li>
    <li>voiceJson(VoiceParamsInterface $p): Voice</li>
</ul>
</details>

##### Tests

Some basic tests are implemented. Run them like this:

```shell script
SMS77_API_KEY= SMS77_RECIPIENT= SMS77_MSG_ID= php vendor/bin/phpunit tests/Client
```

Make sure to fill in the values. SMS77_MSG_ID refers to a message ID sent from this
particular API key. SMS77_RECIPIENT is the recipient of the test SMS.

###### Support

Need help? Feel free to [contact us](https://www.seven.io/en/company/contact/).

[![MIT](https://img.shields.io/badge/License-MIT-teal.svg)](LICENSE)
