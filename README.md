![Sms77.io Logo](https://www.sms77.io/wp-content/uploads/2019/07/sms77-Logo-400x79.png "Sms77.io Logo")
# sms77io PHP API Client

## Installation

```shell script
composer require sms77/api
```

### Usage
```php
use Sms77\Api\Client;
$client = new Client('MYVERYSECRETAPIKEY1234!?');
$client->sms('+4901234567890', 'HI2U');
```

#### Tests
Some basic tests are implemented. Run them like this:
```shell script
SMS77_API_KEY= SMS77_RECIPIENT= SMS77_MSG_ID= php vendor/bin/phpunit tests/Client
```
Make sure to fill in the values.
SMS77_MSG_ID refers to a message ID sent from this particular API key.
SMS77_RECIPIENT is the recipient of the test SMS.