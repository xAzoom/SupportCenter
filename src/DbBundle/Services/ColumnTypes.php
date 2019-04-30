<?php

namespace DbBundle\Services;

class ColumnTypes
{
    const TARRAY = 'array';
    const SIMPLE_ARRAY = 'simple_array';
    const JSON_ARRAY = 'json_array';
    const BIGINT = 'bigint';
    const BOOLEAN = 'boolean';
    const DATETIME = 'datetime';
    const DATETIMETZ = 'datetimetz';
    const DATE = 'date';
    const TIME = 'time';
    const DECIMAL = 'decimal';
    const INTEGER = 'integer';
    const OBJECT = 'object';
    const SMALLINT = 'smallint';
    const STRING = 'string';
    const TEXT = 'text';
    const BINARY = 'binary';
    const BLOB = 'blob';
    const FLOAT = 'float';
    const GUID = 'guid';

    public static function isValidColumnType($type)
    {
        switch ($type) {
            case self::TARRAY:
            case self::SIMPLE_ARRAY:
            case self::JSON_ARRAY:
            case self::BIGINT:
            case self::BOOLEAN:
            case self::DATETIME:
            case self::DATETIMETZ:
            case self::DATE:
            case self::TIME:
            case self::DECIMAL:
            case self::INTEGER:
            case self::OBJECT:
            case self::SMALLINT:
            case self::STRING:
            case self::TEXT:
            case self::BINARY:
            case self::BLOB:
            case self::FLOAT:
            case self::GUID:
                return true;
        }
        return false;
    }
}