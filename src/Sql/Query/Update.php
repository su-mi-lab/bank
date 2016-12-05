<?php

namespace Bank\Sql\Query;

use Bank\Sql\BuilderInterface;
use Bank\Sql\QueryInterface;

/**
 * Class Update
 * @package Bank\Sql\Query
 */
class Update implements QueryInterface
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
        return $this->builder->buildUpdateQuery($this);
    }
}