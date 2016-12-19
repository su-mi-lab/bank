<?php

namespace Bank\Query\Predicate;

/**
 * Class Column
 * @package Bank\Query\Predicate
 */
class Column
{
    /**
     * @var array|string
     */
    private $columns = [];

    /**
     * @param array $column
     * @param string $table
     * @return Column
     */
    public function addColumn(array $column, string $table = null): Column
    {
        $column = [$table => $column];
        $this->columns[] = $column;
        return $this;
    }

    /**
     * @return array
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    public function reset()
    {
        $this->columns = [];
    }
}