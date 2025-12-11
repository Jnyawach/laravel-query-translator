<?php

namespace Nyawach\LaravelQueryTranslator\Enums;

use Nyawach\LaravelQueryTranslator\Traits\EnumToArrayTrait;

enum FunctionEnum:string
{
    use EnumToArrayTrait;

    case COUNT = 'COUNT';
    case SUM = 'SUM';
    case AVG = 'AVG';
    case MAX = 'MAX';
    case MIN = 'MIN';


    public function label(): string
    {
        return match ($this) {
            self::COUNT => 'Count',
            self::SUM => 'Sum',
            self::AVG => 'Avg',
            self::MAX => 'Max',
            self::MIN => 'Min',
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
