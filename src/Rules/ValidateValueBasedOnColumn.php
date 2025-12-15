<?php

namespace Nyawach\LaravelQueryTranslator\Rules;

use Illuminate\Support\Facades\Schema;
use Closure;

class ValidateValueBasedOnColumn
{
    public function __construct(
        private string $tableName,
        private string $columnName
    )
    {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (Schema::hasTable($this->tableName) && Schema::hasColumn($this->tableName,$this->columnName)){

        }else{
            $fail('The :attribute does not match column data type');
        }

    }

}