<?php

namespace Nyawach\LaravelQueryTranslator\Facades;


use Illuminate\Support\Facades\Facade;

class QueryTranslator extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'query-translator';
    }
}
