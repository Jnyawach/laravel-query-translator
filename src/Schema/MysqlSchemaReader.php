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
    public function getTables(string $search=null): array
    {
        $connection = DB::connection($this->connection);
        $databaseName = $connection->getDatabaseName();

        $tables=$connection->table('information_schema.tables')
            ->select(DB::raw('TABLE_NAME as table_name'))
            ->when($search, fn($query, $search) =>
            $query->whereRaw('LOWER(table_name) like ?', ['%' . strtolower($search) . '%'])
            )
            ->where('table_schema', $databaseName)
            ->whereNotIn('table_name', $this->excludedTables)
            ->take(100)
            ->pluck('table_name')
            ->toArray();

        $table_array=[];
        foreach($tables as $table){
            $table_array[]=[
                'label' => Str::title(str_replace('_', ' ', $table)),
                'value' => $table,
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
            ->select(DB::raw('COLUMN_NAME as column_name, DATA_TYPE as data_type'))
            ->get();

        $column_array=[];
        foreach($columns as $column){
            $column_array[]=[
                'label' => Str::title(str_replace('_', ' ', $table)).' : '.Str::title(str_replace('_', ' ', $column->column_name)),
                'data_type' => $column->data_type,
                'value' => $column->column_name,
            ];

        }

        return $column_array;

    }

}
