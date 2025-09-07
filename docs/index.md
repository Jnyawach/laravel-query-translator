---
title: Introduction
weight: 1
---

# Laravel BI Query Translator
## Introduction
The Laravel BI Query Translator is a powerful package that enables developers to convert JSON-based query structures into SQL queries seamlessly. This is particularly useful for building Business Intelligence (BI) tools where users can create complex queries without needing to write SQL code manually.

Once installed, you can easily convert a JSON query structure into a SQL query string. Below is an example of how to use the package:

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
[ {
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

## Database Compatibility

This package is compatible with the following databases:
- MySQL
- PostgreSQL


## Prerequisites
- PHP 7.4 or higher
- Laravel 8.x or higher
- Composer
- A working database connection




