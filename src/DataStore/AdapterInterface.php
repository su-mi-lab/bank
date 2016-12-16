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
     * @return RepoInterface
     */
    public function getRepo(): RepoInterface;
}