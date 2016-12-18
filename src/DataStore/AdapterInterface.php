<?php

namespace Bank\DataStore;

use Bank\Builder\QueryBuilderInterface;

/**
 * Interface AdapterInterface
 * @package Bank\DataStore
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

    /**
     * @return GatewayInterface
     */
    public function getGateway(): GatewayInterface;
}