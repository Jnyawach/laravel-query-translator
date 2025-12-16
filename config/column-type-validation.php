<?php

use Nyawach\LaravelQueryTranslator\Enums\ColumnTypeEnum;

return [
    ColumnTypeEnum::INT->value => [
        'validators' => ['integer']

    ],
    ColumnTypeEnum::BIGINT->value => [
        'validators' => ['integer']
    ],
    ColumnTypeEnum::SMALLINT->value => [
        'validators' => ['integer']
    ],
    ColumnTypeEnum::FLOAT->value => [
        'validators' => ['numeric']
    ],
    ColumnTypeEnum::DOUBLE->value => [
        'validators' => ['numeric']
    ],
    ColumnTypeEnum::DECIMAL->value => [
        'validators' => ['numeric']
    ],
    ColumnTypeEnum::VARCHAR->value => [
        'validators' => ['string']
    ],
    ColumnTypeEnum::CHAR->value => [
        'validators' => ['string']
    ],
    ColumnTypeEnum::TEXT->value => [
        'validators' => ['string']
    ],
    ColumnTypeEnum::ENUM->value => [
        'validators' => ['string']
    ],
    ColumnTypeEnum::BOOLEAN->value => [
        'validators' => ['boolean']
    ],
    ColumnTypeEnum::TINYINT->value => [
        'validators' => ['integer']
    ],
    ColumnTypeEnum::DATE->value => [
        'validators' => ['date']
    ],
    ColumnTypeEnum::DATETIME->value => [
        'validators' => ['date']
    ],
    ColumnTypeEnum::TIMESTAMP->value => [
        'validators' => ['date']
    ],
    ColumnTypeEnum::TIME->value => [
        'validators' => ['date_format:H:i:s']
    ],
    ColumnTypeEnum::JSON->value => [
        'validators' => ['json']
    ],
    ColumnTypeEnum::JSONB->value => [
        'validators' => ['json']
    ],
];
