<?php

namespace Bank\Sql\Query;

use Bank\Sql\BuilderInterface;
use Bank\Sql\QueryInterface;

/**
 * Class Insert
 * @package Bank\Sql\Query
 */
class Insert implements QueryInterface
{
    /**
     * @var BuilderInterface
     */
    private $builder;

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->builder->buildInsertQuery($this);
    }
}