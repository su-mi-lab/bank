<?php

namespace Bank\Sql\Query;

/**
 * Class Insert
 * @package Bank\Sql\Query
 */
class Insert extends Query
{
    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->builder->buildInsertQuery($this);
    }
}