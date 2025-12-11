<?php

namespace Nyawach\LaravelQueryTranslator\Builder;

use Illuminate\Database\Query\Builder;

class SortHandler
{

    public function handle(Builder $query, array $sorts): Builder
    {
        foreach ($sorts as $sort) {
            $query->orderBy(
                $sort['sort_field'],
                $sort['sort_order'] ?? 'asc'
            );
        }
        return $query;
    }
}
