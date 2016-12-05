<?php

namespace Bank\Sql;

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

    function __construct($platform)
    {
        $builder = "\\Bank\\Sql\\Platform\\".$platform;
        $this->builder = new $builder();
    }

    /**
     * @return Select
     */
    public function getSelect(): Select
    {
        return new Select($this->builder);
    }

    /**
     * @return Insert
     */
    public function getInsert(): Insert
    {
        return new Insert($this->builder);
    }

    /**
     * @return Update
     */
    public function getUpdate(): Update
    {
        return new Update($this->builder);
    }

    /**
     * @return Delete
     */
    public function getDelete(): Delete
    {
        return new Delete($this->builder);
    }
}