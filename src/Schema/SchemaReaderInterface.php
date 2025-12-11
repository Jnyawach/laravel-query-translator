<?php

namespace Nyawach\LaravelQueryTranslator\Schema;

interface SchemaReaderInterface
{
    /**
     * Get all tables from the connection.
     *
     * @return array
     */
    public function getTables(): array;

    /**
     * Get columns for a specific table.
     *
     * @param string $table
     * @return array
     */
    public function getColumns(string $table): array;
}
