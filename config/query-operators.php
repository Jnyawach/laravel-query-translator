<?php

use Nyawach\LaravelQueryTranslator\Enums\FilterEnum;

return [
    FilterEnum::EQ->value => [
        'value_validation' => ['required'],
        'value_type' => 'string'
    ],
    FilterEnum::NEQ->value => [
        'value_validation' => ['required'],
        'value_type' => 'string'
    ],
    FilterEnum::GT->value => [
        'value_validation' => ['required'],
        'value_type' => 'string'
    ],
    FilterEnum::GTE->value => [
        'value_validation' => ['required'],
        'value_type' => 'string'
    ],
    FilterEnum::LT->value => [
        'value_validation' => ['required'],
        'value_type' => 'string'
    ],
    FilterEnum::LTE->value => [
        'value_validation' => ['required'],
        'value_type' => 'string'
    ],
    FilterEnum::IN->value => [
        'value_validation' => ['required', 'array'],
        'value_type' => 'array'
    ],
    FilterEnum::NOT_IN->value => [
        'value_validation' => ['required', 'array'],
        'value_type' => 'array'
    ],
    FilterEnum::BETWEEN->value => [
        'value_validation' => ['required', 'array', 'size:2'],
        'value_type' => 'array'
    ],
    FilterEnum::NOT_BETWEEN->value => [
        'value_validation' => ['required', 'array', 'size:2'],
        'value_type' => 'array'
    ],
    FilterEnum::STARTS_WITH->value => [
        'value_validation' => ['required'],
        'value_type' => 'string'
    ],
    FilterEnum::ENDS_WITH->value => [
        'value_validation' => ['required'],
        'value_type' => 'string'
    ],
    FilterEnum::IS_NULL->value => [
        'value_validation' => ['nullable'],
        'value_type' => 'null'
    ],
    FilterEnum::IS_NOT_NULL->value => [
        'value_validation' => ['nullable'],
        'value_type' => null
    ],
    FilterEnum::IS_EMPTY->value => [
        'value_validation' => ['nullable'],
        'value_type' => null
    ],
    FilterEnum::IS_NOT_EMPTY->value => [
        'value_validation' => ['nullable'],
        'value_type' => null
    ],
];