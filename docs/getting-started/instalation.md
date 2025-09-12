# Installation

This guide will help you install **Nova Poshta API Client for PHP** into your project.  
Let's keep it simple and working.

---

## Requirements

Make sure your environment has:

- **PHP >= 5.4** (yes, legacy support for OpenCart 1.5, why not 🤷‍♂️)
- **cURL extension**
- **JSON extension**
- **Composer**

> No Composer? Go get it. Seriously. Or check how autoload works.

---

## Installing the package

Currently, this package is **not on Packagist**. So we go GitHub route.

1. **Add the repository to your `composer.json`**

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/soldred/novaposhta-api-client"
        }
    ],
    "require": {
        "soldred/novaposhta-api-client": "main"
    }
}
```

> `"main"` = latest commit. Easy, right?

---

2. **Install / Update dependencies**

```bash
composer install
```

Or, if you already have other stuff:

```bash
composer update
```

Composer will fetch the library and put it in `vendor/`.

** Quick test **

Make a file, test.php:

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use NovaPoshta\src\NovaPoshtaApiClient;

// initialize
$client = new NovaPoshtaApiClient('YOUR_API_KEY');

// fetch warehouse types
$response = $client->Address->getWarehouseTypes();

print_r($response);
```

Run it:

```bash
php test.php
```

If you see warehouse types printed, congrats — installation works ✅

> ⚠️ Pro tip: if something breaks, check PHP version, extensions, and your API key.
Also, remember, this works for legacy stuff AND modern projects. One library to rule them all 🪄