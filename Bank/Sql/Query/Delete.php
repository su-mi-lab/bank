<?php

namespace Bank\Sql\Query;

use Bank\Sql\BuilderInterface;
use Bank\Sql\QueryInterface;

/**
 * Class Delete
 * @package Bank\Sql\Query
 */
class Delete implements QueryInterface
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
        return $this->builder->buildDeleteQuery();
    }
}