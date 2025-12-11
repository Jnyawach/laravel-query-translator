<?php

namespace Nyawach\LaravelQueryTranslator\Builder;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Nyawach\LaravelQueryTranslator\Validator\QueryJsonValidator;

 class BaseHandler
{
   protected array $handlers;

    public function __construct(

    ) {
        $this->handlers = config('query-translator.handlers');
    }

    public function execute(array $json)
    {
        //validate query
        QueryJsonValidator::validate($json);

        $connection = $json['connection'] ?? null;
        $query = ConnectionManager::table($json['table'], $connection);

        if (isset($this->handlers['join'])) {
            app($this->handlers['join'])->handle($query, $json['joins'] ?? []);
        }

        if (isset($this->handlers['filter'])) {
            app($this->handlers['filter'])->handle($query, $json['filters'] ?? []);
        }

        if (isset($this->handlers['summarization'])) {
            app($this->handlers['summarization'])->handle($query, $json['summary'] ?? []);
        }

        if (isset($this->handlers['sort'])) {
            app($this->handlers['sort'])->handle($query, $json['sort'] ?? []);
        }

        return $query->get();
    }


}
