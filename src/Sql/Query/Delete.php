<?php

namespace Bank\Sql\Query;

/**
 * Class Delete
 * @package Bank\Sql\Query
 */
class Delete extends Query
{

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->builder->buildDeleteQuery($this);
    }
}