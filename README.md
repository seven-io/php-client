<img src="https://www.seven.io/wp-content/uploads/Logo.svg" width="250" />

# seven.io PHP SDK

[![Latest Stable Version](https://img.shields.io/packagist/v/seven.io/api.svg)](https://packagist.org/packages/seven.io/api)
[![Total Downloads](https://img.shields.io/packagist/dt/seven.io/api.svg)](https://packagist.org/packages/seven.io/api)
[![License](https://img.shields.io/badge/License-MIT-teal.svg)](LICENSE)
[![PHP Version](https://img.shields.io/packagist/php-v/seven.io/api.svg)](https://packagist.org/packages/seven.io/api)

**The official PHP SDK for the seven.io SMS Gateway API**

[Documentation](https://www.seven.io/en/docs/gateway/http-api/) • [API Reference](/docs) • [Support](https://www.seven.io/en/company/contact/) • [Dashboard](https://app.seven.io/)

---

## 📦 Installation

### Via Composer (recommended)

```bash
composer require seven.io/api
```

### Manual Installation

Download the latest release as [ZIP file](https://github.com/seven-io/php-client/releases/latest) and include it in your project.

## 🚀 Quick Start

### Send your first SMS

```php
<?php
require 'vendor/autoload.php';

use Seven\Api\Client;
use Seven\Api\Resource\Sms\SmsParams;
use Seven\Api\Resource\Sms\SmsResource;

// Initialize the client with your API key
$client = new Client('YOUR_API_KEY');

// Create SMS resource
$smsResource = new SmsResource($client);

// Send SMS
$response = $smsResource->dispatch(
    new SmsParams('Hello from seven.io!', '+491234567890')
);

echo "SMS sent successfully! ID: " . $response->getMessages()[0]->getId();
```

## 📱 Features

### SMS Messaging
- ✅ Send SMS to single or multiple recipients
- ✅ Bulk SMS support
- ✅ Flash SMS
- ✅ Unicode support
- ✅ Delivery reports
- ✅ Schedule messages

### Voice Calls
- ✅ Text-to-Speech calls
- ✅ Voice message broadcasts

### Number Lookup
- ✅ HLR (Home Location Register) lookup
- ✅ Number format validation
- ✅ Carrier information
- ✅ Number portability check

### Other Features
- ✅ Balance inquiry
- ✅ Pricing information
- ✅ Webhook management
- ✅ Contact management
- ✅ Analytics & Journal

## 💻 Usage Examples

### Send SMS with custom sender

```php
$params = (new SmsParams('Your message here', '+491234567890'))
    ->setFrom('YourBrand')
    ->setUnicode(true)
    ->setFlash(false);
    
$response = $smsResource->dispatch($params);
```

### Send bulk SMS

```php
$params = new SmsParams(
    'Bulk message to multiple recipients',
    ['+491234567890', '+491234567891', '+491234567892']
);

$response = $smsResource->dispatch($params);
```

### Schedule SMS for later

```php
$params = (new SmsParams('Scheduled message', '+491234567890'))
    ->setDelay(new \DateTime('+1 hour'));
    
$response = $smsResource->dispatch($params);
```

### Perform HLR lookup

```php
use Seven\Api\Resource\Lookup\LookupResource;

$lookupResource = new LookupResource($client);
$result = $lookupResource->hlr('+491234567890');

echo "Carrier: " . $result->getCarrier();
echo "Country: " . $result->getCountry();
```

### Check account balance

```php
use Seven\Api\Resource\Balance\BalanceResource;

$balanceResource = new BalanceResource($client);
$balance = $balanceResource->get();

echo "Current balance: €" . $balance->getAmount();
```

### Text-to-Speech call

```php
use Seven\Api\Resource\Voice\VoiceResource;
use Seven\Api\Resource\Voice\VoiceParams;

$voiceResource = new VoiceResource($client);
$params = new VoiceParams('+491234567890', 'Hello, this is a test call');

$response = $voiceResource->call($params);
```

## 🔧 Advanced Configuration

### Initialize with signing secret (for webhook validation)

```php
$client = new Client(
    apiKey: 'YOUR_API_KEY',
    signingSecret: 'YOUR_SIGNING_SECRET'
);
```

### Error Handling

```php
use Seven\Api\Exception\InvalidApiKeyException;
use Seven\Api\Exception\InsufficientBalanceException;

try {
    $response = $smsResource->dispatch($params);
} catch (InvalidApiKeyException $e) {
    echo "Invalid API key provided";
} catch (InsufficientBalanceException $e) {
    echo "Not enough balance to send SMS";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

## 🧪 Testing

Run the test suite with your API credentials:

```bash
# Using production API key
SEVEN_API_KEY=your_api_key php vendor/bin/phpunit tests

# Using sandbox API key
SEVEN_API_KEY_SANDBOX=your_sandbox_key php vendor/bin/phpunit tests
```

### Run specific tests

```bash
# Test only SMS functionality
php vendor/bin/phpunit tests/SmsTest.php

# Test with verbose output
php vendor/bin/phpunit tests --verbose
```

## 📚 API Resources

The SDK provides access to all seven.io API endpoints:

| Resource | Description |
|----------|-------------|
| `AnalyticsResource` | Analytics and statistics |
| `BalanceResource` | Account balance |
| `ContactsResource` | Contact management |
| `HooksResource` | Webhook management |
| `JournalResource` | Message history |
| `LookupResource` | Number lookup & validation |
| `PricingResource` | Pricing information |
| `RcsResource` | RCS messaging |
| `SmsResource` | SMS messaging |
| `StatusResource` | Delivery reports |
| `SubaccountsResource` | Subaccount management |
| `ValidateForVoiceResource` | Voice number validation |
| `VoiceResource` | Voice calls |

## 🔑 Environment Variables

| Variable | Description |
|----------|-------------|
| `SEVEN_API_KEY` | Your production API key |
| `SEVEN_API_KEY_SANDBOX` | Your sandbox API key for testing |
| `SEVEN_SIGNING_SECRET` | Webhook signing secret |

## 📄 Requirements

- PHP 8.1 or higher
- Composer (for installation)
- ext-curl
- ext-json

## 🤝 Contributing

We welcome contributions! Please see our [Contributing Guide](CONTRIBUTING.md) for details.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 🆘 Support

- 📖 [API Documentation](https://www.seven.io/en/docs/gateway/http-api/)
- 💬 [Contact Support](https://www.seven.io/en/company/contact/)
- 🐛 [Report Issues](https://github.com/seven-io/php-client/issues)
- 💡 [Feature Requests](https://github.com/seven-io/php-client/issues/new?labels=enhancement)

## 📜 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

Made with ❤️ by [seven.io](https://www.seven.io)
