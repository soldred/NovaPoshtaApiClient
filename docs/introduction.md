# Introduction

This library provides a convenient way to work with the [Nova Poshta API v2.0](https://developers.novaposhta.ua/).  
It is written in PHP and designed to be easily integrated into different projects, including:

- **OpenCart** (1.5–3.x, should also work on 4.x)
- **Laravel**
- **Symfony**
- Any other PHP project

---

## Why use this library?

- **Simple** — you don't need to manually build JSON requests.
- **Consistent** — each API method is represented as a clear PHP method.
- **Flexible** — can be used both inside frameworks (OpenCart, Laravel) and standalone.
- **Extensible** — easy to add new models or extend existing ones.

---

## Supported PHP versions

The package works with **PHP 5.4 and above**.  
This allows integration even into legacy systems (such as OpenCart 1.5), while still being compatible with modern PHP projects.

In the future, we plan to maintain two main branches:
- **Legacy** — PHP 5.4+ (for old projects)
- **Modern** — PHP 7.3+ (with modern language features)

👉 See [Roadmap](roadmap.md) for details

---

## Structure of documentation

- [Getting Started](getting-started/installation.md) — installation and first request
- [Models](models/) — detailed description of available models (`Address`, `Counterparty`, `InternetDocument`, etc.)
- [Usage Examples](usage_example.md) — advanced scenarios with combined requests
- [FAQ](faq.md) — common questions and troubleshooting

---

## Example

A simple example of fetching the first 5 cities:

```php
<?php
require __DIR__ . '/vendor/autoload.php';

$api = new NovaPoshtaApi('your_api_key');

$response = $api->Address->getCities(['Limit' => 5]);

print_r($response);
```