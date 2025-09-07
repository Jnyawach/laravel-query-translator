<?php

namespace Nyawach\LaravelQueryTranslator\Enums;

enum FilterEnum:string
{
    case IS= 'is';
    case IS_NOT = 'is_not';
    case LIKE = 'like';
    case NOT_LIKE = 'not_like';
    case IN = 'in';
    case NOT_IN = 'not_in';
    case BETWEEN = 'between';
    case NOT_BETWEEN = 'not_between';
    case IS_NULL = 'is_null';
    case IS_NOT_NULL = 'is_not_null';
    case CONTAINS = 'contains';
    case NOT_CONTAINS = 'not_contains';
    case STARTS_WITH = 'starts_with';
    case NOT_STARTS_WITH = 'not_starts_with';
    case ENDS_WITH = 'ends_with';
    case NOT_ENDS_WITH = 'not_ends_with';
    case IS_EMPTY = 'is_empty';
    case IS_NOT_EMPTY = 'is_not_empty';

    public function label(): string
    {
        return match ($this) {
            self::IS => 'Is',
            self::IS_NOT => 'Is Not',
            self::LIKE => 'Like',
            self::NOT_LIKE => 'Not Like',
            self::IN => 'In',
            self::NOT_IN => 'Not In',
            self::BETWEEN => 'Between',
            self::NOT_BETWEEN => 'Not Between',
            self::IS_NULL => 'Is Null',
            self::IS_NOT_NULL => 'Is Not Null',
            self::CONTAINS => 'Contains',
            self::NOT_CONTAINS => 'Not Contains',
            self::STARTS_WITH => 'Starts With',
            self::NOT_STARTS_WITH => 'Not Starts With',
            self::ENDS_WITH => 'Ends With',
            self::NOT_ENDS_WITH => 'Not Ends With',
            self::IS_EMPTY => 'Is Empty',
            self::IS_NOT_EMPTY => 'Is Not Empty',
            default => 'Unknown',
        };
    }

    public static function all():array
    {
        return array_map(function ($case) {
            return [
                'value' => $case->value,
                'label' => $case->label(),
            ];
        }, self::cases());
    }

}
