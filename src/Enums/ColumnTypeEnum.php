<?php

namespace Nyawach\LaravelQueryTranslator\Enums;

enum ColumnTypeEnum:string
{
    case INT = 'INT';
    case BIGINT = 'BIGINT';
    case SMALLINT = 'SMALLINT';
    case FLOAT = 'FLOAT';
    case DOUBLE = 'DOUBLE';
    case DECIMAL = 'DECIMAL';
    case VARCHAR = 'VARCHAR';
    case CHAR = 'CHAR';
    case TEXT = 'TEXT';
    case ENUM = 'ENUM';
    case BOOLEAN = 'BOOLEAN';
    case TINYINT = 'TINYINT';
    case DATE = 'DATE';
    case DATETIME = 'DATETIME';
    case TIMESTAMP = 'TIMESTAMP';
    case TIME = 'TIME';
    case JSON = 'JSON';
    case JSONB = 'JSONB';

}
