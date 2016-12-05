<?php

namespace Bank\Sql;

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
     * @return Select
     */
    public function getSelect(): Select
    {
        return new Select;
    }

    /**
     * @return Insert
     */
    public function getInsert(): Insert
    {
        return new Insert;
    }

    /**
     * @return Update
     */
    public function getUpdate(): Update
    {
        return new Update;
    }

    /**
     * @return Delete
     */
    public function getDelete(): Delete
    {
        return new Delete;
    }
}