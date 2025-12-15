<?php

namespace Nyawach\LaravelQueryTranslator\Validator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Nyawach\LaravelQueryTranslator\Enums\FilterEnum;
use Nyawach\LaravelQueryTranslator\Enums\FunctionEnum;
use Nyawach\LaravelQueryTranslator\Enums\JoinTypeEnum;
use Nyawach\LaravelQueryTranslator\Enums\OperatorEnum;
use Nyawach\LaravelQueryTranslator\Enums\SortEnum;
use Nyawach\LaravelQueryTranslator\Rules\ValidateColumnExists;
use Nyawach\LaravelQueryTranslator\Rules\ValidateSchemaExists;

class JsonQueryRequest extends FormRequest
{
     /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules():array
    {
        return [
            'table'=>['required', 'string', new ValidateSchemaExists()],

            //validate joins
            'joins'=>['nullable','array'],
            'joins.*.left_table'=>['required_with:joins', 'string',new ValidateSchemaExists()],
            'joins.*.join_type'=>['required_with:joins', 'string',Rule::enum(JoinTypeEnum::class)],
            'joins.*.right_table'=>['required_with:joins', 'string'],

            //validate conditions
            'joins.*.conditions'=>['required_with:joins', 'array'],
            'joins.*.conditions.*.left_column'=>[
                'required_with:joins.*.conditions',
                'string',
                new ValidateColumnExists($this->request->input('joins.*.left_table'))
            ],
            'joins.*.conditions.*.operator'=>['required_with:joins.*.conditions', 'string',Rule::enum(OperatorEnum::class)],
            'joins.*.conditions.*.right_column'=>[
                'required_with:joins.*.conditions',
                'string',
                new ValidateColumnExists($this->request->input('joins.*.right_table'))
            ],

            'filters'=>['nullable','array'],
            'filters.*.table'=>[
                'nullable',
                'required_with:filters',
                'string',
                new ValidateSchemaExists()
            ],
            'filters.*.column'=>[
                'nullable',
                'required_with:filters',
                'string',
                new ValidateColumnExists($this->request->input('filters.*.table'))
            ],
            'filters.*.operator'=>['required_with:filters', 'string', Rule::enum(FilterEnum::class)],
            'filters.*.value'=>config('query-operators')[$this->request->input('filters.*.operator')]['value_validation'],

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
    }

}
