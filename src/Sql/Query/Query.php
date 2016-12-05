<?php

namespace Bank\Sql\Query;

use Bank\Sql\Platform\BuilderInterface;

/**
 * Class Query
 * @package Bank\Sql\Query
 */
abstract class Query implements QueryInterface
{
    /**
     * @var BuilderInterface
     */
    protected $builder;

    function __construct($builder)
    {
        $this->builder = $builder;
    }
}