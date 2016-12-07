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

            $val = $this->castConditionValue($condition["val"]);
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

    /**
     * @param $conditionValue
     * @return array|null|string
     */
    protected function castConditionValue($conditionValue)
    {
        $value = null;
        if (is_array($conditionValue)) {
            $value = array_map(function ($item) {
                return $this->quote($item);
            }, $conditionValue);

            $value = "(" . implode(" , ", $value) . ")";
        } else if (!empty($conditionValue)) {
            $value = $this->quote($conditionValue);
        }

        return $value;
    }
}