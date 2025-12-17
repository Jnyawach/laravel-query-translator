<?php

namespace Nyawach\LaravelQueryTranslator\Enums;

enum JoinTypeEnum:string
{
    case INNER_JOIN = 'inner_join';
    case LEFT_JOIN = 'left_join';
    case RIGHT_JOIN = 'right_join';
    case FULL_JOIN = 'full_join';
    case CROSS_JOIN = 'cross_join';

    public function label(): string
    {
        return match ($this) {
            self::INNER_JOIN => 'Inner Join',
            self::LEFT_JOIN => 'Left Join',
            self::RIGHT_JOIN => 'Right Join',
            self::FULL_JOIN => 'Full Join',
            self::CROSS_JOIN => 'Cross Join',
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
