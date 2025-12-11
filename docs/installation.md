---
title: Installation
weight: 2
---

## Compatibility
See the [Documentation Compatibility](docs/index.md#database-compatibility) for database compatibility details.

# Installation
Follow these steps to install the package:
-  Install the package vi a Composer by running the following command in your terminal:
```bash
composer require nyawach/laravel-query-translator
```
- (Optional) Publish the configuration file using the following command:
```bash
php artisan vendor:publish --provider="Nyawach\LaravelQueryTranslator\QueryTranslatorProvider" --tag="config"
```
This will create a `query-translator.php` file in your `config` directory, where you can customize the package settings.

- The package uses the default database connection defined in your Laravel application. Ensure that your database is properly configured in the `.env` file. If
you need to use a different connection, you can specify it in the configuration file.

## Default Configuration
You can view the default at: [https://github.com/Jnyawach/laravel-query-translator/blob/main/config/query-translator.php](https://github.com/Jnyawach/laravel-query-translator/blob/main/config/query-translator.php)