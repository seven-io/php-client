<p align='center'>
    <img
         width="400" 
         height="79" 
         src="https://www.sms77.io/wp-content/uploads/2019/07/sms77-Logo-400x79.png" alt="sms77io Logo"
      />
</p>

<h1 align='center'>sms77io PHP API Client</h1>

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

#### Implemented Endpoints

- sms
- status
- balance
- pricing
- lookup
- contacts
- voice
- validate_for_voice