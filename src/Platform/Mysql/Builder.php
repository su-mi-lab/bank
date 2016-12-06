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

        if (is_array($table)) {
            $alias = array_keys($table);
            $tableName = array_values($table);
            return "FROM `" . reset($tableName) . "` AS `" . reset($alias) . "`";
        }

        return "FROM `{$table}`";
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

            $condition_val = $condition["val"];

            $val = null;
            if (is_array($condition_val)) {
                $val = array_map(function ($item) {
                    return $this->quote($item);
                }, $condition_val);

                $val = "(" . implode(" , ", $val) . ")";
            } else if (!empty($condition_val)) {
                $val = $this->quote($condition_val);
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