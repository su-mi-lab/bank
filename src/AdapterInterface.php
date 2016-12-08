<?php

namespace Bank;

use Bank\Platform\QueryBuilderInterface;
use Bank\Platform\ConnectionInterface;

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