<?php

namespace Nyawach\LaravelQueryTranslator\Enums;

enum FilterEnum:string
{
    case EQ = '=';
    case NEQ = '!=';
    case GT = '>';
    case GTE = '>=';
    case LT = '<';
    case LTE = '<=';
    case IN = 'IN';
    case NOT_IN = 'NOT_IN';
    case BETWEEN = 'BETWEEN';
    case NOT_BETWEEN = 'NOT_BETWEEN';
    case STARTS_WITH = 'STARTS_WITH';
    case ENDS_WITH = 'ENDS_WITH';
    case IS_NULL = 'IS_NULL';
    case IS_NOT_NULL = 'IS_NOT_NULL';
    case IS_EMPTY = 'IS_EMPTY';
    case IS_NOT_EMPTY = 'IS_NOT_EMPTY';

    public function label(): string
    {
        return match ($this) {
            self::EQ => 'Equal',
            self::NEQ => 'Not Equal',
            self::GT => 'Greater Than',
            self::GTE => 'Greater Than Or Equal',
            self::LT => 'Less Than',
            self::LTE => 'Less Than Or Equal',
            self::IN => 'In',
            self::NOT_IN => 'Not In',
            self::BETWEEN => 'Between',
            self::NOT_BETWEEN => 'Not Between',
            self::STARTS_WITH => 'Starts With',
            self::ENDS_WITH => 'Ends With',
            self::IS_NULL => 'Is Null',
            self::IS_NOT_NULL => 'Is Not Null',
            self::IS_EMPTY => 'Is Empty',
            self::IS_NOT_EMPTY => 'Is Not Empty',
            default => 'Unknown'
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
