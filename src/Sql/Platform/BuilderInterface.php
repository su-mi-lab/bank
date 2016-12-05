<?php

namespace Bank\Sql\Platform;
use Bank\Sql\Query\Delete;
use Bank\Sql\Query\Insert;
use Bank\Sql\Query\Select;
use Bank\Sql\Query\Update;

/**
 * Interface BuilderInterface
 * @package Bank\Driver\Platform
 */
interface BuilderInterface
{
    /**
     * @param Select $query
     * @return string
     */
    public function buildSelectQuery(Select $query): string;

    /**
     * @param Insert $query
     * @return string
     */
    public function buildInsertQuery(Insert $query): string;

    /**
     * @param Update $query
     * @return string
     */
    public function buildUpdateQuery(Update $query): string;

    /**
     * @param Delete $query
     * @return string
     */
    public function buildDeleteQuery(Delete $query): string;

}