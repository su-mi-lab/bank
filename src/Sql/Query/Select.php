<?php

namespace Bank\Sql\Query;

/**
 * Class Select
 * @package Bank\Sql\Query
 */
class Select extends Query
{

    private $from;

    /**
     * @var
     */
    private $where;

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->builder->buildSelectQuery($this);
    }

    /**
     * @param $table
     * @return Select
     */
    public function from($table): Select
    {
        $this->from = $table;
        return $this;
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }
}