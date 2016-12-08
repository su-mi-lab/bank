<?php

namespace Bank\Query\Builder;

use Bank\Query\Clause\Where;

/**
 * Class WhereBuilder
 * @package Bank\Query\Builder
 *
 * @method protected
 * \Bank\Platform\QueryBuilder::enclosedInBracket($params),
 * \Bank\Platform\QueryBuilder::quote(string $string):string,
 * \Bank\Platform\QueryBuilder::QueryBuilder::divideFirstParam($table)
 */
trait WhereBuilder
{
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

            $value = $condition["value"] ?? null;
            $join = $condition["join"] ?? null;

            if ($value instanceof Where) {
                return $this->buildNestWhere($query, $value, $join);
            }

            return $this->buildSimpleWhere($query, $condition);
        }, []);

        $where = implode("", $query);

        return $where;
    }

    /**
     * @param array $query
     * @param array $condition
     * @return array
     */
    protected function buildSimpleWhere(array $query, array $condition): array
    {
        $conditionVal = $condition["value"] ?? null;
        $col = $condition["col"] ?? null;
        $operator = $condition["operator"] ?? null;
        $join = $condition["join"] ?? null;

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