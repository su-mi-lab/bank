<?php

namespace Bank\Platform\Mysql;

use Bank\Platform\QueryBuilder;
use Bank\Query\Clause\From;
use Bank\Query\Clause\Where;
use phpDocumentor\Reflection\DocBlock\Tags\Param;

/**
 * Class Builder
 * @package Bank\Platform
 */
class Builder extends QueryBuilder
{
    /**
     * @param From $from
     * @return string
     */
    protected function buildFrom(From $from): string
    {
        $table = $from->getTable();

        $from = null;
        switch (is_array($table)) {
            case true:
                $alias = array_keys($table);
                $tableName = array_values($table);
                $from = "FROM `" . reset($tableName) . "` AS `" . reset($alias) . "`";
                break;
            default:
                $from = "FROM `{$table}`";
                break;
        }

        return $from;
    }

    /**
     * @param Where $where
     * @return string
     */
    protected function buildWhere(Where $where): string
    {
        $conditions = $where->getConditions();

        if (!$conditions) {
            return "";
        }

        $query = array_reduce($conditions, function ($query, $condition) {

            $val = $condition["val"];

            if (is_array($val)) {
                $val = array_map(function ($item) {
                    return $this->quote($item);
                }, $val);

                $val = "(" . implode(" , ", $val) . ")";
            } else if (!empty($val)) {
                $val = $this->quote($val);
            } else {
                $val = null;
            }

            $col = $condition["col"];
            $operator = $condition["operator"];

            if (!empty($condition["table"])) {
                $col = $condition["table"] . "." . $col;
            }

            $query[] = ($val) ? "{$col} {$operator} {$val}" : "{$col} {$operator}";

            return $query;
        }, []);

        $where = implode(" AND ", $query);

        return " WHERE {$where} ";
    }
}