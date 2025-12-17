<?php

namespace Nyawach\LaravelQueryTranslator\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Closure;
use Illuminate\Support\Facades\Schema;

class ValidateColumnExists implements ValidationRule
{
    public function __construct(
        private mixed $field,
        private string $fieldName
    )
    {}
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Extract the index using explode
        $segments = explode('.', $attribute);
        $index = $segments[1];
        $tableName = $this->field[$index][$this->fieldName] ?? null;
        if (!$tableName) {
            $fail("The table for index {$index} is missing.");
            return;
        }

        // Validate table & column existence
        if (Schema::hasTable($tableName)){
            if(!Schema::hasColumn($tableName,$value)){
                $fail('The :attribute does not exist in the table-'.$tableName.'.');
            }
        }else{
            $fail("The table for index {$index} is missing.");
        }

    }
}