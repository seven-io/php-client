# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is the **seven.io PHP SDK**, an official API client for the seven.io SMS Gateway API. It's a PHP library that provides a clean, object-oriented interface for all seven.io services including SMS, Voice, RCS messaging, number lookup, and analytics.

## Development Commands

### Testing
```bash
# Run all tests with production API key
SEVEN_API_KEY=your_api_key php vendor/bin/phpunit tests

# Run all tests with sandbox API key (preferred for development)
SEVEN_API_KEY_SANDBOX=your_sandbox_key php vendor/bin/phpunit tests

# Run specific test file
php vendor/bin/phpunit tests/SmsTest.php

# Run tests with verbose output
php vendor/bin/phpunit tests --verbose
```

### Documentation Generation
```bash
# Generate API documentation (outputs to docs/ directory)
php vendor/bin/phpdoc
```

### Package Management
```bash
# Install dependencies
composer install

# Install without dev dependencies
composer install --no-dev

# Update dependencies
composer update
```

## Architecture Overview

### Core Components

1. **Client (`src/Client.php`)** - The main HTTP client that handles all API communication
   - Manages authentication via API keys and optional signing secrets
   - Handles all HTTP methods (GET, POST, PATCH, DELETE)
   - Implements request signing for webhook verification
   - Manages error handling and exception throwing

2. **Resources** - Each API endpoint group has its own resource class
   - All extend `src/Resource/Resource.php` abstract class
   - Located in `src/Resource/*/` directories (Analytics, Sms, Voice, etc.)
   - Each resource handles specific API functionality (SMS sending, lookups, etc.)

3. **Parameter Objects** - Type-safe parameter classes for API requests
   - Follow naming pattern: `*Params.php` (e.g., `SmsParams`, `VoiceParams`)
   - Implement validation and provide fluent interfaces

4. **Response Objects** - Structured response classes for API responses
   - Located alongside their respective resources
   - Provide type-safe access to response data

### Directory Structure

```
src/
├── Client.php                    # Main HTTP client
├── Exception/                    # Custom exception classes
├── Library/                      # Shared utilities and enums
└── Resource/                     # API resource implementations
    ├── Resource.php              # Abstract base class
    ├── Analytics/                # Analytics and reporting
    ├── Balance/                  # Account balance
    ├── Contacts/                 # Contact management
    ├── Groups/                   # Contact groups
    ├── Hooks/                    # Webhook management
    ├── Journal/                  # Message history
    ├── Lookup/                   # Number lookup/validation
    ├── Numbers/                  # Phone number management
    ├── Pricing/                  # Pricing information
    ├── Rcs/                      # RCS messaging
    ├── Sms/                      # SMS messaging (primary feature)
    ├── Status/                   # Delivery status
    ├── Subaccounts/              # Subaccount management
    ├── ValidateForVoice/         # Voice validation
    └── Voice/                    # Voice calls
```

### Key Design Patterns

1. **Resource Pattern** - Each API endpoint group is encapsulated in a Resource class
2. **Parameter Objects** - Request parameters are wrapped in typed parameter objects
3. **Exception Hierarchy** - Custom exceptions for different API error types
4. **Client Composition** - Resources receive the Client instance for HTTP operations

## Testing Environment

### Environment Variables
- `SEVEN_API_KEY` - Production API key for live testing
- `SEVEN_API_KEY_SANDBOX` - Sandbox API key for safe testing (preferred)
- `SEVEN_SIGNING_SECRET` - Optional webhook signing secret

### Test Structure
- All tests extend `tests/BaseTest.php`
- Uses `tests/Resources.php` as a resource factory for consistent test setup
- Tests are organized by resource type (SmsTest.php, VoiceTest.php, etc.)
- Tests can switch between production and sandbox environments

## Common Development Patterns

### Creating a New Resource
1. Create resource class extending `Resource` in appropriate namespace
2. Create parameter classes implementing `ParamsInterface`
3. Create response/data classes for API responses
4. Add validator classes if complex validation is needed
5. Add corresponding test class extending `BaseTest`

### Exception Handling
The client automatically handles API error codes:
- `900` - Invalid API Key
- `901` - Signing Hash Verification Failed
- `902` - Missing Access Rights
- `903` - Forbidden IP
- `600` - General API Error

### Request Authentication
The Client supports two authentication methods:
1. API Key only (standard)
2. API Key + Signing Secret (for webhook verification)

## Requirements

- PHP 8.2+
- Required extensions: curl, json, mbstring, ctype
- Development extensions: xdebug, soap, simplexml