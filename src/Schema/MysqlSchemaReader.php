<?php

namespace Nyawach\LaravelQueryTranslator\Schema;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MysqlSchemaReader implements SchemaReaderInterface
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
        $connection = DB::connection($this->connection);
        $databaseName = $connection->getDatabaseName();

        $tables=$connection->table('information_schema.tables')
            ->select(DB::raw('TABLE_NAME as table_name'))
            ->where('table_schema', $databaseName)
            ->whereNotIn('table_name', $this->excludedTables)
            ->pluck('table_name')
            ->toArray();

        $table_array=[];
        foreach($tables as $table){
            $table_array[]=[
                'label' => Str::title(str_replace('_', ' ', $table)),
                'column' => $table,
            ];

        }
        return $table_array;
    }

    public function getColumns(string $table): array
    {
        $connection = DB::connection($this->connection);
        $databaseName = $connection->getDatabaseName();
        $columns= $connection
            ->table('information_schema.columns')
            ->where('table_schema', $databaseName)
            ->where('table_name', $table)
            ->select(DB::raw('COLUMN_NAME as column_name'))
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
