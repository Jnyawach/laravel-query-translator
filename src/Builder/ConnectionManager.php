<?php

namespace Nyawach\LaravelQueryTranslator\Builder;
use Illuminate\Support\Facades\DB;

class ConnectionManager
{
    public static function table(string $table, ?string $connection = null)
    {
        if ($connection) {
            return DB::connection($connection)->table($table);
        }

        // fallback to default from config
        $default = config('query-translator.connection', config('database.default'));

        return DB::connection($default)->table($table);
    }

}
