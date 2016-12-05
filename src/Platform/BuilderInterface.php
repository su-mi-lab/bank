<?php

namespace Bank\Platform;

use Bank\Query\Delete;
use Bank\Query\Insert;
use Bank\Query\Select;
use Bank\Query\Update;

/**
 * Interface BuilderInterface
 * @package Bank\Platform
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