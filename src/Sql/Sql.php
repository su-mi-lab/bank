<?php

namespace Bank\Sql;

use Bank\Driver\Platform\ConnectionInterface;
use Bank\Sql\Platform\BuilderInterface;
use Bank\Sql\Query\Delete;
use Bank\Sql\Query\Insert;
use Bank\Sql\Query\Select;
use Bank\Sql\Query\Update;

/**
 * Class Sql
 * @package Bank\Sql
 */
class Sql implements SqlInterface
{
    /**
     * @var BuilderInterface
     */
    private $builder;

    /**
     * @var ConnectionInterface
     */
    private $connection;

    function __construct($platform, $connection)
    {
        $builder = "\\Bank\\Sql\\Platform\\".$platform;
        $this->builder = new $builder();
        $this->connection = $connection;
    }

    /**
     * @return Select
     */
    public function getSelect(): Select
    {
        return new Select($this->builder, $this->connection);
    }

    /**
     * @return Insert
     */
    public function getInsert(): Insert
    {
        return new Insert($this->builder, $this->connection);
    }

    /**
     * @return Update
     */
    public function getUpdate(): Update
    {
        return new Update($this->builder, $this->connection);
    }

    /**
     * @return Delete
     */
    public function getDelete(): Delete
    {
        return new Delete($this->builder, $this->connection);
    }
}