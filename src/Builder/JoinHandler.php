<?php

namespace Nyawach\LaravelQueryTranslator\Builder;
use Illuminate\Database\Query\Builder;

class JoinHandler
{
    public function handle(Builder $query, array $joins): Builder
    {
        foreach ($joins as $join) {
            $query->join(
                $join['join_table'],
                $join['join_table'] . '.' . $join['join_column'],
                $join['join_operator'] ?? '=',
                $join['primary_column']
            );
        }
        return $query;
    }
}
