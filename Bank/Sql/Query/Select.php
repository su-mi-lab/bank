<?php

namespace Bank\Sql\Query;

use Bank\Sql\BuilderInterface;
use Bank\Sql\QueryInterface;

/**
 * Class Select
 * @package Bank\Sql\Query
 */
class Select implements QueryInterface
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
        return $this->builder->buildSelectQuery();
    }
}