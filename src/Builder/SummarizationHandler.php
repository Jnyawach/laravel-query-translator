<?php

namespace Nyawach\LaravelQueryTranslator\Builder;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Nyawach\LaravelQueryTranslator\Enums\FunctionEnum;

class SummarizationHandler
{
    public function handle(Builder $query, array $summary): Builder
    {
        if (!empty($summary['summarizations'])) {
            foreach ($summary['summarizations'] as $sum) {
                if (!empty($sum['summarization_operator']) && !empty($sum['summarization_column'])) {
                    $operator = strtoupper($sum['summarization_operator']);
                    $column   = $sum['summarization_column'];

                    if (in_array($operator, FunctionEnum::array())) {
                        $query->addSelect(DB::raw("{$operator}({$column}) as {$operator}_{$column}"));
                    }
                }
            }
        }

        // group by
        if (!empty($summary['group_by'])) {
            foreach ($summary['group_by'] as $group) {
                if (!empty($group['group_by_column'])) {
                    $col = $group['group_by_column'];
                    $query->addSelect($col)->groupBy($col);
                }
            }
        }

        return $query;
    }
}
