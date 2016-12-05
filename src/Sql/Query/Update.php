<?php

namespace Bank\Sql\Query;

/**
 * Class Update
 * @package Bank\Sql\Query
 */
class Update extends Query
{

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->builder->buildUpdateQuery($this);
    }
}