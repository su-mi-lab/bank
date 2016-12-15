<?php

namespace Bank;

use Bank\Builder\QueryBuilderInterface;
use Bank\DataAccess\ConnectionInterface;

/**
 * Interface AdapterInterface
 * @package Bank
 */
interface AdapterInterface
{

    /**
     * @return ConnectionInterface
     */
    public function getConnection(): ConnectionInterface;

    /**
     * @return QueryBuilderInterface
     */
    public function getQueryBuilder(): QueryBuilderInterface;

}