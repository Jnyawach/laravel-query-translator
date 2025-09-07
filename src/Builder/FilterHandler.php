<?php

namespace Nyawach\LaravelQueryTranslator\Builder;

use Illuminate\Database\Query\Builder;

class FilterHandler
{

    public function handle(Builder $query, array $filters): Builder
    {
        foreach ($filters as $filter) {
            $query->where(
                $filter['filter_column'],
                $filter['filter_operator'],
                $filter['filter_value']
            );
        }
        return $query;
    }
}
