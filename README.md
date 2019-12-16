# Sms77.io PHP API

## Installation

```shell script
composer require sms77/api
```

### Usage
```php
use Sms77\Api\Client;
$client = new Client('MYVERYSECRETAPIKEY1234!?');
$client->sms('00491755523119', 'HI2U');
```

#### Implemented Endpoints

- sms
- status
- balance
- pricing
- lookup
- contacts
- voice
- validate_for_voice