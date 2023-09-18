![](https://www.seven.io/wp-content/uploads/Logo.svg "seven Logo")

# Official PHP API Client

## Installation

**Via Composer:**

```shell script 
composer require seven.io/api
```

Alternatively you
can [download as *.ZIP](https://github.com/seven-io/php-client/releases/latest "download as *.ZIP")
if you don't use Composer.

### Usage

```php
use Seven\Api\Client;
use Seven\Api\Params\SmsParams;
$client = new Client('MY_VERY_SECRET_API_KEY!');
$params = new SmsParams('HI2U', '+4901234567890');
$client->sms($params);
```

See [docs](/docs) for more details.

##### Tests

Some basic tests are implemented. You can run them like this:

```shell script
SEVEN_API_KEY=<API-KEY> php vendor/bin/phpunit tests/Client
```

Make sure to fill in the values.

###### Support

Need help? Feel free to [contact us](https://www.seven.io/en/company/contact/).

[![MIT](https://img.shields.io/badge/License-MIT-teal.svg)](LICENSE)
