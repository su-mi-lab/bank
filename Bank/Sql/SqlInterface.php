<?php

namespace Bank\Sql;

use Bank\Sql\Query\Delete;
use Bank\Sql\Query\Insert;
use Bank\Sql\Query\Select;
use Bank\Sql\Query\Update;

/**
 * Interface SqlInterface
 * @package Bank\Driver\Platform
 */
interface SqlInterface
{
    /**
     * @return Select
     */
    public function getSelect(): Select;

    /**
     * @return Insert
     */
    public function getInsert(): Insert;

    /**
     * @return Update
     */
    public function getUpdate(): Update;

    /**
     * @return Delete
     */
    public function getDelete(): Delete;

}