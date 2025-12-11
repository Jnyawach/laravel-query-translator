<?php

namespace Nyawach\LaravelQueryTranslator\Schema;

use Illuminate\Support\Facades\DB;

class SchemaReaderFactory
{
    public static function make():  SchemaReaderInterface
    {
        $connection = config('query-translator.connection');
        $driver = DB::connection($connection)->getDriverName();
        return match ($driver) {
            'mysql' => new MysqlSchemaReader($connection),
            'pgsql' => new PostgresSchemaReader($connection),
            default => throw new \RuntimeException("Unsupported driver: {$driver}"),
        };
    }
}
