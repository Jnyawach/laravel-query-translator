<?php

namespace Nyawach\LaravelQueryTranslator\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Closure;
use Illuminate\Support\Facades\Validator;

class ValidateFieldRule implements ValidationRule
{
    public function __construct(protected array $filters) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $index = explode('.', $attribute)[1];
        $operator = $this->filters[$index]['operator'] ?? null;
        if (!$operator){
            return;
        }
        $rules=config('query-operators')[$operator]['value_validation'];

        $data=[];
        if (in_array('array', $rules)){
            $data= $rules;
            $data['filters.*.value.*']=config('query-operators')[$operator]['value_validation'];
        }else{
            $data= [
                $rules,
                ...config('query-operators')[$operator]['value_validation']

            ];
        }
        $validator=Validator::make([$attribute=>$value],$data);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                // Pass the sub-validator errors back to the main validation
                $fail($message);
            }
        }

    }

}