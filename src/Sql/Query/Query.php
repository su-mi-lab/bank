<?php

namespace Bank\Sql\Query;

use Bank\Driver\Platform\ConnectionInterface;
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

    /**
     * @var ConnectionInterface
     */
    protected $connection;

    /**
     * Query constructor.
     * @param $builder
     * @param $connection
     */
    function __construct($builder, $connection)
    {
        $this->builder = $builder;
        $this->connection = $connection;
    }

    /**
     * @param $string
     * @return string
     */
    public function quote($string):string
    {
        return $this->connection->query($string);
    }
}