# Nova Poshta API Client for PHP

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
![PHP](https://img.shields.io/badge/PHP-%3E=5.4-8892BF.svg?style=flat-square&logo=php)
![Composer](https://img.shields.io/badge/Composer-ready-orange?style=flat-square&logo=composer)
![GitHub last commit](https://img.shields.io/github/last-commit/soldred/novaposhta-api-client?style=flat-square)
![Made with ❤️](https://img.shields.io/badge/made_with-%E2%9D%A4-red?style=flat-square)


> **⚠️ Work in Progress: Please Read**
>
> This library is currently under not very active development. While the core models are functional and stable, not all official API endpoints have been implemented yet. Please check the [Available Models](#available-models) section to see what is currently supported. Contributions are welcome!

A simple and modern PHP API client for the Nova Poshta service in Ukraine.

This library provides a convenient, object-oriented interface for all Nova Poshta API models, making integration into your projects fast and easy. It is designed to be lightweight, efficient (using lazy loading), and compatible with older PHP versions.

## Sections
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation-from-github)
- [Quick Start](#quick-start)
- [Available models](#available-models)
- [Documentation](#documentation)
- [License](#license)

## Features

- **Full API Coverage:** All major models and methods are implemented.
- **Modern Architecture:** Uses Composer, PSR-4 autoloading, and namespaces for clean, maintainable code.
- **Efficient:** Employs lazy loading for models to save memory and improve performance. Models are only instantiated when you first access them.
- **High Compatibility:** Works with PHP 5.4 and higher.
- **Clean and Simple:** An intuitive, object-oriented interface (e.g., `$client->Address->getCities()`).
- **Zero Dependencies:** No external libraries are required.

## Requirements

- PHP >= 5.4 (needed for legacy support, e.g., OpenCart 1.5)
- cURL extension
- JSON extension
- Composer

## Installation (from GitHub)

This package is not yet available on Packagist. You can install it directly from the GitHub repository.

1.  **Modify your project's `composer.json`**
    Add the repository URL to your `composer.json` file. This tells Composer where to find the package.

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
    *(Note:`"main"` means it will use the latest commit from the `main` branch.)*

2.  **Install the package**
    Now, run the standard Composer install command in your project's root directory:

    ```bash
    composer install
    ```
    Or if you already have other packages:
    ```bash
    composer update
    ```
    Composer will now download the library directly from your GitHub repository.

## Quick Start

Here is a basic example of how to use the client.

```php
<?php

// 1. Include the Composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

// 2. Use the main client class
use NovaPoshta\src\NovaPoshtaApiClient;

// 3. Initialize the client with your API key
$client = new NovaPoshtaApiClient('YOUR_API_KEY');

// --- Example 1: Making a standard API request ---
    
// Access the model as a property and call its method
$response = $client->Address->getCities(['FindByString' => 'Київ', 'Limit' => 5]);

foreach ($response['data'] as $city) {
    echo "- " . $city['Description'] . "\n";
}

// --- Example 2: Generating a print URL ---

$documentRefs = ['20450012345678', '20450012345679'];
    
// Access the sub-model and call its method
$printUrl = $client->PrintedForm->InternetDocument->getPrintUrl($documentRefs);

echo "\nGenerated URL for printing:\n";
echo $printUrl . "\n";

// --- Example 3: Creating counterparty

$response = $np->Counterparty->createCounterparty([
    "FirstName" => "Петро",
    "MiddleName" => "Тестович",
    "LastName" => "Отримуваченко",
    "Phone" => "380790533660",
    "email" => "testrecipientpetro@test.com"
],
    Counterparty::TYPE_PRIVATE_PERSON,
    Counterparty::PROPERTY_RECIPIENT
);

var_dump($response);
```

## Available models

You can access all API models as properties of the client object.

* Address
* Common
* ContactPerson
* Counterparty
* Courier (partial support)
* InternetDocument
* Tracking
* Registers
* PrintedForm
    * PrintedForm->InternetDocument
    * PrintedForm->Marking
    * PrintedForm->Registers


## Documentation

Official Nova Poshta API docs: [developers.novaposhta.ua/documentation](https://developers.novaposhta.ua/documentation)
This client is just a PHP wrapper. For details about specific request/response parameters, please refer to the official docs.

## Roadmap

- [ ] Implement all API models (Courier, AdditionalService, etc.)
- [ ] Add more usage examples
- [ ] Add unit tests
- [ ] Publish on Packagist


## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
