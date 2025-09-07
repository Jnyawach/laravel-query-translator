<?php

namespace Nyawach\LaravelQueryTranslator\Enums;

enum ConditionEnum:string
{

    case AND = 'AND';
    case OR = 'OR';


    public function label(): string
    {
        return match ($this) {
            self::AND => 'AND',
            self::OR => 'OR',
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
