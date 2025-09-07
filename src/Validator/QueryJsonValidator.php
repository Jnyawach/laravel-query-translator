<?php

namespace Nyawach\LaravelQueryTranslator\Validator;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Nyawach\LaravelQueryTranslator\Enums\FilterEnum;
use Nyawach\LaravelQueryTranslator\Enums\FunctionEnum;
use Nyawach\LaravelQueryTranslator\Enums\JoinTypeEnum;
use Nyawach\LaravelQueryTranslator\Enums\OperatorEnum;
use Nyawach\LaravelQueryTranslator\Enums\SortEnum;

class QueryJsonValidator
{
    public static function validate($data):void
    {
        $rules = [
            'table'=>['required', 'string'],
            'joins'=>['nullable','array'],
            'joins.*.primary'=>['required_with:jsons', 'string'],
            'joins.*.join_type'=>['required_with:jsons', 'string',Rule::enum(JoinTypeEnum::class)],
            'joins.*.join_table'=>['required_with:jsons', 'string'],
            'joins.*.join_column'=>['required_with:jsons', 'string'],
            'joins.*.join_operator'=>['required_with:jsons', 'string', Rule::enum(OperatorEnum::class)],

            'filters'=>['nullable','array'],
            'filters.*.filter_column'=>['required_with:filters', 'string'],
            'filters.*.filter_operator'=>['required_with:filters', 'string', Rule::enum(FilterEnum::class)],
            'filters.*.filter_value'=>['nullable', 'string','required_unless:'.FilterEnum::IS_EMPTY->value.','.FilterEnum::IS_NOT_EMPTY->value],

            'summary'=>['nullable'],
            'summary.summarizations'=>['required_with:summary', 'array'],
            'summary.summarizations.*.summarization_column'=>['required_with:summary.*.summarizations', 'string'],
            'summary.summarizations.*.summarization_operation'=>['required_with:summary.*.summarizations', 'string',Rule::enum(FunctionEnum::class)],
            'summary.group_by'=>['nullable', 'array'],
            'summary.group_by.*.group_by_column'=>['required_with:group_by', 'string'],

            'sort'=>['nullable', 'array'],
            'sort.*.sort_field'=>['required_with:sort', 'string'],
            'sort.*.sort_order'=>['required_with:sort', 'string', Rule::enum(SortEnum::class)],

        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

    }

}
