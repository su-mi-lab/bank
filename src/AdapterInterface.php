<?php

namespace Bank;

use Bank\Builder\QueryBuilderInterface;
use Bank\DataAccess\ConnectionInterface;
use Bank\DataAccess\RepoInterface;

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

    /**
     * @return RepoInterface
     */
    public function getRepo(): RepoInterface;
}