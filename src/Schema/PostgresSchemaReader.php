<?php

namespace Nyawach\LaravelQueryTranslator\Schema;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostgresSchemaReader implements SchemaReaderInterface
{

    protected string $connection;
    protected array $excludedTables;
    protected array $excludedColumns;

    public function __construct(string $connection)
    {
        $this->connection = $connection;
        $this->excludedTables = config('query-translator.excluded_tables', []);
        $this->excludedColumns = config('query-translator.excluded_columns', []);
    }

    public function getTables(): array
    {

        $tables= DB::connection($this->connection)
            ->table('information_schema.tables')
            ->where('table_schema', 'public')
            ->where('table_type', 'BASE TABLE')
            ->whereNotIn('table_name', $this->excludedTables)
            ->pluck('table_name')
            ->toArray();
        $table_array=[];
        foreach($tables as $table){
            $table_array[]=[
                'label' => Str::title(str_replace('_', ' ', $table)),
                'table' => $table,
            ];

        }
        return $table_array;

    }

    public function getColumns(string $table): array
    {
        $columns= DB::connection($this->connection)
            ->table('information_schema.columns')
            ->where('table_schema', 'public')
            ->where('table_name', $table)
            ->whereNotIn('column_name', $this->excludedColumns)
            ->pluck('column_name')
            ->toArray();
        $column_array=[];
        foreach($columns as $column){
            $column_array[]=[
                'label' => Str::title(str_replace('_', ' ', $table)).' : '.Str::title(str_replace('_', ' ', $column)),
                'column' => $column,
            ];

        }

        return $column_array;
    }
}
