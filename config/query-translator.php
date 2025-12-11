<?php

return[
    /*
      |--------------------------------------------------------------------------
      | Database Connection
      |--------------------------------------------------------------------------
      |
      | This package will use this database connection for all read queries.
      | You can set it to null to use the default connection from your config.
      |
      */
    'connection' => env('DB_CONNECTION_M', null),

    /*
     * |-------------------------------------------------------------------------
     * | Excluded Tables and Columns
     * |-------------------------------------------------------------------------
     * | List of tables and columns that should not be included in the query builder.
     * | This is useful for tables that are not relevant to the application
     * | or contain sensitive information.
     * | You can add your own tables to this list.
     */
    'excluded_tables' => [
        'migrations',
    ],
    'excluded_columns' => [
        'password',
    ],
    'handlers'=>[
        'join'=>\Nyawach\LaravelQueryTranslator\Builder\JoinHandler::class,
        'filter'=>\Nyawach\LaravelQueryTranslator\Builder\FilterHandler::class,
        'sort'=>\Nyawach\LaravelQueryTranslator\Builder\SortHandler::class,
        'summarization'=>\Nyawach\LaravelQueryTranslator\Builder\SummarizationHandler::class,
    ]
];
