<?php

namespace Bank\Sql\Query;

/**
 * Interface QueryInterface
 * @package Bank\Sql\Query
 */
interface QueryInterface
{
    /**
     * @return string
     */
    public function getQuery(): string;

}