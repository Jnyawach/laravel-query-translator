<?php

namespace Nyawach\LaravelQueryTranslator\Rules;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Schema;

class ValidateSchemaExists implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!Schema::hasTable($value)){
            $fail('The :attribute does not exist in the database.');
        }
    }
}