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
     * @return string
     */
    public function getQuery(): string
    {
        return $this->builder->buildSelectQuery($this);
    }

    /**
     * @param $table
     * @return $this
     */
    public function from($table)
    {
        $this->from = $table;
        return $this;
    }

    public function getFrom()
    {
        return $this->from;
    }
}