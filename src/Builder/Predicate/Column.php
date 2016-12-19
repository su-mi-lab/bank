<?php

namespace Bank\Builder\Predicate;

use Bank\Builder\PredicateBuilder;
use Bank\Query\Predicate\Column as SelectQuery;

/**
 * Class Column
 * @package Bank\Builder\Predicate
 */
class Column extends PredicateBuilder
{
    /**
     * @param SelectQuery $column
     * @return string
     */
    public function build($column): string
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
                $alias = (!is_numeric($key)) ? $key : null;
                return $this->quoteSelectPredicate($col, $table, $alias, $list);
            }, $list);
        }

        $query = $this->quote($column, '`');
        $query = $this->addTable($query, $table);
        $query = $this->addAlias($query, $alias);

        $list[] = $query;
        return $list;
    }

    /**
     * @param $query
     * @param $table
     * @return string
     */
    protected function addTable($query, $table): string
    {
        if ($table) {
            $query = $this->quote($table, '`') . '.' . $query;
        }

        return $query;
    }

    /**
     * @param $query
     * @param $alias
     * @return string
     */
    protected function addAlias($query, $alias) : string
    {
        if ($alias) {
            $query = $query . ' AS ' . $this->quote($alias, '`');
        }

        return $query;
    }
}