<?php

namespace Bank\Platform\Mysql;

use Bank\Platform\QueryBuilder;
use Bank\Query\Clause\From;
use Bank\Query\Clause\Where;

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
            $table_name = array_values($table);
            return "FROM `" . reset($table_name) . "` AS `" . reset($alias) . "`";
        } else {
            return "FROM `{$table}`";
        }
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

                $val = "(".implode(" , ", $val).")";
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

            if ($val) {
                $query[] = "{$col} {$operator} {$val}";
            } else {
                $query[] = "{$col} {$operator}";
            }

            return $query;
        }, []);

        $where = implode(" AND ", $query);

        return " WHERE {$where} ";
    }
}