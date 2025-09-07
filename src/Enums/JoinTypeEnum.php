<?php

namespace Nyawach\LaravelQueryTranslator\Enums;

enum JoinTypeEnum:string
{
    case INNER = 'inner';
    case LEFT = 'left';
    case RIGHT = 'right';

    public function label(): string
    {
        return match ($this) {
            self::INNER => 'Inner',
            self::LEFT => 'Left',
            self::RIGHT => 'Right',
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
