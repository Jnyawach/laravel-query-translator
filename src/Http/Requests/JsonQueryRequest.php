<?php

namespace Nyawach\LaravelQueryTranslator\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Nyawach\LaravelQueryTranslator\Enums\FilterEnum;
use Nyawach\LaravelQueryTranslator\Enums\FunctionEnum;
use Nyawach\LaravelQueryTranslator\Enums\JoinTypeEnum;
use Nyawach\LaravelQueryTranslator\Enums\OperatorEnum;
use Nyawach\LaravelQueryTranslator\Enums\SortEnum;
use Nyawach\LaravelQueryTranslator\Rules\ValidateColumnExists;
use Nyawach\LaravelQueryTranslator\Rules\ValidateFieldRule;
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
                new ValidateColumnExists($this->input('joins',[]),'left_table')
            ],
            'joins.*.conditions.*.operator'=>['required_with:joins.*.conditions', 'string',Rule::enum(OperatorEnum::class)],
            'joins.*.conditions.*.right_column'=>[
                'required_with:joins.*.conditions',
                'string',
                new ValidateColumnExists($this->input('joins',[]),'right_table')
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
                new ValidateColumnExists($this->input('filters',[]),'table')
            ],
            'filters.*.operator'=>['required_with:filters', 'string', Rule::enum(FilterEnum::class)],
            'filters.*.value'=>new ValidateFieldRule($this->input('filters', [])),

           // Selected Columns
            'selected_columns'=>[
                'nullable',
                'array',
            ],
            'selected_columns.*.table'=>[
                'nullable',
                'required_with:selected_columns',
                'string', new ValidateSchemaExists()
            ],
            'selected_columns.*.column'=>[
                'nullable',
                'required_with:selected_columns',
                'string',
                new ValidateColumnExists($this->input('selected_columns'),'table')
            ],
            'selected_columns.*.alias'=>['nullable','required_with:selected_columns','string'],

            //Group By
            'group_by'=>['nullable', 'array'],
            'group_by.*.table' => [
                'nullable',
                'required_with:group_by',
                'string',
                new ValidateSchemaExists()
            ],
            'group_by.*.column'=>[
                'nullable',
                'required_with:group_by',
                'string',
                new ValidateColumnExists($this->input('group_by'),'table')
            ],


            //Aggregation
            'aggregations'=>['nullable', 'array'],
            'aggregations.*.function'=>[
                'nullable',
                'required_with:aggregations',
                'string', Rule::enum(FunctionEnum::class)
            ],
            'aggregations.*.table'=>[

            ],
            'aggregations.*.column'=>[
                'nullable',
                'required_with:aggregations',
                'string',

            ],

            'sort'=>['nullable', 'array'],
            'sort.*.sort_field'=>['required_with:sort', 'string'],
            'sort.*.sort_order'=>['required_with:sort', 'string', Rule::enum(SortEnum::class)],

        ];
    }

}
