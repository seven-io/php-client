![Sms77.io Logo](https://www.sms77.io/wp-content/uploads/2019/07/sms77-Logo-400x79.png "Sms77.io Logo")


# sms77io PHP API Client


## Installation

**Via Composer:**
```shell script 
composer require sms77/api 
```

Alternatively you can [download as *.ZIP](https://github.com/sms77io/php-client/releases/latest "download as *.ZIP") if you don't use Composer.


### Usage

```php
use Sms77\Api\Client;
$client = new Client('MYVERYSECRETAPIKEY1234!?');
$client->sms('+4901234567890', 'HI2U');
```


#### Methods

<details>
<summary>Analytics</summary>


<ul>
    <li>analytics(array options, string $groupBy = 'date'): AbstractAnalytic[]</li>
    <li>analyticsByCountry(array options): AnalyticByCountry[]</li>
    <li>analyticsByDate(array options): AnalyticByDate[]</li>
    <li>analyticsByLabel(array options): AnalyticByLabel[]</li>
    <li>analyticsBySubaccount(array options): AnalyticBySubaccount[]</li>
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
    <li>deleteContact(int $id, bool $json = false): int|ContactDelete</li>
    <li>editContact(array $options = []): int|ContactEdit</li>
    <li>getContact(int $id, bool $json = false): string|Contact[]</li>
    <li>getContacts(bool $json = false): string|Contact[]</li>
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
</ul>
</details>

<details>
<summary>Pricing</summary>

<ul>
    <li>pricing(bool $json = true, string $country = ''): string|Pricing</li>
</ul>
</details>

<details>
<summary>SMS</summary>

<ul>
    <li>sms(string $to, string $text, array $options = []): string|Sms</li>
</ul>
</details>

<details>
<summary>Status</summary>

<ul>
    <li>status(int $msgId, bool $json = false): string|Status</li>
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
    <li>voice(string $to, string $text, bool $xml = false, bool $json = false): string|Voice</li>
</ul>
</details>


##### Tests

Some basic tests are implemented. Run them like this:
```shell script
SMS77_API_KEY= SMS77_RECIPIENT= SMS77_MSG_ID= php vendor/bin/phpunit tests/Client
```
Make sure to fill in the values.
SMS77_MSG_ID refers to a message ID sent from this particular API key.
SMS77_RECIPIENT is the recipient of the test SMS.