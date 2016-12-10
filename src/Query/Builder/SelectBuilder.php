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
            return $this->quoteSelectPredicate($cols, $table, null, $query);
        }, []);

        return implode(',', $select);
    }

    /**
     * @param $column
     * @param string $table
     * @param string $alias
     * @param array $list
     * @return array
     */
    protected function quoteSelectPredicate($column, string $table, $alias, array $list): array
    {
        if (is_array($column)) {
            return array_reduce(array_keys($column), function ($list, $key) use ($table, $column) {
                $col = $column[$key];

                $alias = null;
                if (!is_numeric($key)) {
                    $alias = $key;
                }

                return $this->quoteSelectPredicate($col, $table, $alias, $list);
            }, $list);
        }

        $query = $this->quote($column, '`');
        if ($table) {
            $query = $this->quote($table, '`') . '.' . $query;
        }

        if ($alias) {
            $query = $query . ' AS ' . $this->quote($alias, '`');
        }

        $list[] = $query;
        return $list;
    }

}