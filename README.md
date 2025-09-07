# Laravel  BI Query Translator

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nyawach/laravel-query-translator.svg?style=flat-square)](https://packagist.org/packages/nyawach/laravel-query-translator)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/nyawach/laravel-query-translator/run-tests.yml?branch=main&label=tests)](https://github.com/nyawach/laravel-query-translator/actions/workflows/run-tests.yml)
[![Downloads](https\://img.shields.io/packagist/dt/nyawach/laravel-query-translator.svg?style=flat-square)](https\://packagist.org/packages/nyawach/laravel-query-translator)

## Documentation, Installation, and Usage
Please visit the [Documentation](docs/README.md) for detailed instructions on how to install and use this package.

## What It Does
This package allows you to quickly generate SQL queries from a JSON-based query structure. It is particularly useful for building Business Intelligence (BI) tools, where users can create complex queries through a user-friendly JSON without needing to write SQL code manually.
Once installed you can be able to convert a JSON query structure into a SQL query string. See the example below:

```php
use Nyawach\LaravelQueryTranslator\Facades\QueryTranslator;

$query=[
  "table" => "lunar_orders"
  "joins" => []
  "filters" => []
  "summary" => [
    "summarizations" =>  [
       [
        "summarization_operator" => "SUM"
        "summarization_column" => "sub_total"
      ]
       [
        "summarization_operator" => "COUNT"
        "summarization_column" => "id"
      ]
    ]
    "group_by" => [
      [
        "group_by_column" => "status"
      ]
    ]
  ]
  "sort" => []
];

return QueryTranslator::execute($request->all());
// and get
[
    {
        "SUM_sub_total": "130000",
        "COUNT_id": 2,
        "status": "dispatched"
    },
    {
        "SUM_sub_total": "225000",
        "COUNT_id": 3,
        "status": "order-cancelled"
    },
    {
        "SUM_sub_total": "130000",
        "COUNT_id": 2,
        "status": "order-delivered"
    },
    {
        "SUM_sub_total": "910000",
        "COUNT_id": 1,
        "status": "payment-offline"
    },
    {
        "SUM_sub_total": "485000",
        "COUNT_id": 7,
        "status": "payment-received"
    }
]
```