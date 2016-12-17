<?php

namespace Bank\Builder;

use Bank\Query\Delete;
use Bank\Query\Insert;
use Bank\Query\Select;
use Bank\Query\Update;

/**
 * Interface QueryBuilderInterface
 * @package Bank\Builder
 */
interface QueryBuilderInterface
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

    /**
     * @return array
     */
    public function getBindValue(): array;
}