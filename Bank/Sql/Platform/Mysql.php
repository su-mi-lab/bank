<?php

namespace Bank\Sql\Platform;

use Bank\Sql\BuilderInterface;

/**
 * Class Mysql
 * @package Bank\Sql\Platform
 */
class Mysql implements BuilderInterface
{

    /**
     * @return string
     */
    public function buildQuery(): string
    {
        // TODO: Implement getStatement() method.
    }

    /**
     * @return string
     */
    public function buildSelectQuery(): string
    {
        // TODO: Implement buildSelectQuery() method.
    }

    /**
     * @return string
     */
    public function buildInsertQuery(): string
    {
        // TODO: Implement buildInsertQuery() method.
    }

    /**
     * @return string
     */
    public function buildUpdateQuery(): string
    {
        // TODO: Implement buildUpdateQuery() method.
    }

    /**
     * @return string
     */
    public function buildDeleteQuery(): string
    {
        // TODO: Implement buildDeleteQuery() method.
    }
}