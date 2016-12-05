<?php

namespace Bank\Sql\Query;

/**
 * Class Select
 * @package Bank\Sql\Query
 */
class Select extends Query
{
    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->builder->buildSelectQuery($this);
    }
}