<?php

namespace Nyawach\LaravelQueryTranslator\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Closure;
use Illuminate\Support\Facades\Schema;

class ValidateColumnExists implements ValidationRule
{
    public function __construct(private string $tableName)
    {}
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (Schema::hasTable($this->tableName)){
            if(!Schema::hasColumn($this->tableName,$value)){
                $fail('The :attribute does not exist in the table-'.$this->tableName.'.');
            }
        }else{
            $fail('The :attribute does not exist in the database.');
        }

    }
}