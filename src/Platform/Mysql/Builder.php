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
     * @see QueryBuilder::buildFrom
     * @param From $from
     * @return string
     */
    protected function buildFrom(From $from): string
    {
        $table = $from->getTable();

        list($alias, $tableName) = $this->divideFirstParam($table);

        $from_clause = "`{$tableName}`";
        if ($alias) {
            $from_clause = "`" . $tableName . "` AS `" . $alias . "`";
        }

        return $from_clause;
    }


    /**
     * @see QueryBuilder::buildWhere
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

            $conditionVal = $condition["value"] ?? null;
            $col = $condition["col"] ?? null;
            $operator = $condition["operator"] ?? null;
            $join = $condition["join"] ?? null;

            #region nest
            if ($conditionVal instanceof Where) {
                return $this->buildNestWhere($query, $conditionVal, $join);
            }
            #endregion

            $value = $this->castWhereValue($conditionVal);

            list($table, $column) = $this->divideFirstParam($col);
            if ($table) {
                $col = $table . "." . $column;
            }

            $where = ($value) ? "{$col} {$operator} {$value}" : "{$col} {$operator}";
            if ($query) {
                $where = " {$join} {$where}";
            }

            $query[] = $where;

            return $query;
        }, []);

        $where = implode("", $query);

        return $where;
    }

    /**
     * @param array $query
     * @param Where $where
     * @param string $join
     * @return array
     */
    protected function buildNestWhere(array $query, Where $where, string $join): array
    {
        $nest = $this->enclosedInBracket($this->buildWhere($where));
        if ($query) {
            $nest = " {$join} {$nest}";
        }
        $query[] = $nest;
        return $query;
    }

    /**
     * @param $conditionVal
     * @return string
     */
    protected function castWhereValue($conditionVal): string
    {
        $value = "";
        if (is_array($conditionVal)) {
            $value = array_map(function ($item) {
                return $this->quote($item);
            }, $conditionVal);

            $value = $this->enclosedInBracket(implode(" , ", $value));
        } else if (!empty($conditionVal)) {
            $value = $this->quote($conditionVal);
        }

        return $value;
    }

}