<?php

namespace Nyawach\LaravelQueryTranslator\Enums;

enum OperatorEnum:string
{

    case EQUAL = 'equal';
    case NOT_EQUAL = 'not_equal';
    case GREATER_THAN = 'greater_than';
    case LESS_THAN = 'less_than';
    case GREATER_THAN_OR_EQUAL = 'greater_than_or_equal';
    case LESS_THAN_OR_EQUAL = 'less_than_or_equal';


    public function label(): string
    {
        return match ($this) {
            self::EQUAL => 'Equal',
            self::NOT_EQUAL => 'Not Equal',
            self::GREATER_THAN => 'Greater Than',
            self::LESS_THAN => 'Less Than',
            self::GREATER_THAN_OR_EQUAL => 'Greater Than Or Equal',
            self::LESS_THAN_OR_EQUAL => 'Less Than Or Equal',


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
