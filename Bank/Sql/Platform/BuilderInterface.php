<?php

namespace Bank\Sql;

/**
 * Interface BuilderInterface
 * @package Bank\Driver\Platform
 */
interface BuilderInterface
{
    /**
     * @return string
     */
    public function buildSelectQuery(): string;

    /**
     * @return string
     */
    public function buildInsertQuery(): string;

    /**
     * @return string
     */
    public function buildUpdateQuery(): string;

    /**
     * @return string
     */
    public function buildDeleteQuery(): string;

}