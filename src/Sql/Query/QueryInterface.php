<?php

namespace Bank\Sql;

/**
 * Interface QueryInterface
 * @package Bank\Driver\Platform
 */
interface QueryInterface
{
    /**
     * @return string
     */
    public function getQuery(): string;

}