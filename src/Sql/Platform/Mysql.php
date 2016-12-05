<?php

namespace Bank\Sql\Platform;

use Bank\Sql\Query\Delete;
use Bank\Sql\Query\Insert;
use Bank\Sql\Query\Select;
use Bank\Sql\Query\Update;

/**
 * Class Mysql
 * @package Bank\Sql\Platform
 */
class Mysql implements BuilderInterface
{

    /**
     * @param Select $query
     * @return string
     */
    public function buildSelectQuery(Select $query): string
    {

    }

    /**
     * @param Insert $query
     * @return string
     */
    public function buildInsertQuery(Insert $query): string
    {

    }

    /**
     * @param Update $query
     * @return string
     */
    public function buildUpdateQuery(Update $query): string
    {

    }

    /**
     * @param Delete $query
     * @return string
     */
    public function buildDeleteQuery(Delete $query): string
    {
        
    }
}