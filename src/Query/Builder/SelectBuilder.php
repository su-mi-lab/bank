<?php

namespace Bank\Query\Builder;

use Bank\Query\Predicate\Column;

/**
 * Class SelectBuilder
 * @package Bank\Query\Builder
 *
 * @method protected
 * \Bank\Platform\QueryBuilder::enclosedInBracket($params),
 * \Bank\Platform\QueryBuilder::quote(string $string):string,
 * \Bank\Platform\QueryBuilder::QueryBuilder::divideFirstParam($table)
 */
trait SelectBuilder
{
    /**
     * @param Column $column
     * @return string
     */
    protected function buildSelect(Column $column): string
    {
        $columns = $column->getColumns();

        if (!$columns) {
            return " *";
        }

        return " " . $this->castSelectPredicate($columns);
    }

    /**
     * @param array $columns
     * @return string
     */
    protected function castSelectPredicate(array $columns): string
    {
        $select = array_reduce($columns, function ($query, $column) {
            list($table, $cols) = $this->divideFirstParam($column);
            return $this->quoteSelectPredicate($cols, $table, $query);
        }, []);

        return implode(',', $select);
    }

    /**
     * @param $column
     * @param $table
     * @param $list
     * @return array
     */
    protected function quoteSelectPredicate($column, $table, $list): array
    {
        if (is_array($column)) {
            return array_reduce($column, function ($list, $col) use ($table) {
                return $this->quoteSelectPredicate($col, $table, $list);
            }, $list);
        }

        $query = $this->quote($column);
        if ($table) {
            $query = $this->quote($table) . '.' . $query;
        }

        $list[] = $query;
        return $list;
    }

}