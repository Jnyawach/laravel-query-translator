<?php

namespace Nyawach\LaravelQueryTranslator\Rules;

use Illuminate\Support\Facades\Schema;
use Closure;
use Nyawach\LaravelQueryTranslator\Enums\ColumnTypeEnum;

class ValidateValueBasedOnColumn
{
    public function __construct(
        private string $tableName,
        private string $columnName,
        private string $operator
    )
    {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (Schema::hasTable($this->tableName) && Schema::hasColumn($this->tableName,$this->columnName)){
           $columnType = Schema::getColumnType($this->tableName, $this->columnName);
            $filter_rules=config('query-operators')[$this->operator]['value_validation'];
           if (in_array('array', $filter_rules)){
               $rules=[
                   $filter_rules,
                   ...config('query-operators')[$this->operator]['value_validation']
               ];
           }else{

           }
        }else{
            $fail('The :attribute does not match column data type');
        }

    }

}