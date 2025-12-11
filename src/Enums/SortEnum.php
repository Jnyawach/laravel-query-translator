<?php

namespace Nyawach\LaravelQueryTranslator\Enums;

enum SortEnum:string
{

    case ASC = 'asc';
    case DESC = 'desc';

    public function label(): string
    {
        return match ($this) {
            self::ASC => 'Ascending',
            self::DESC => 'Descending',
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
