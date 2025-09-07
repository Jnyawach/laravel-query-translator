<?php

namespace Nyawach\LaravelQueryTranslator\Facades;

use Illuminate\Support\Facades\Facade;

class SchemaReader extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'schema-reader';
    }

}
