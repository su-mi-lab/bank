<?php

namespace Bank;

use Bank\Builder\QueryBuilderInterface;
use Bank\DataAccess\Connection;
use Bank\DataAccess\ConnectionInterface;

/**
 * Class Adapter
 * @package Bank
 */
class Adapter implements AdapterInterface
{

    /**
     * @var ConnectionInterface
     */
    private $conn;

    /**
     * @var QueryBuilderInterface
     */
    private $queryBuilder;

    /**
     * Adapter constructor.
     * @param string $dns
     * @param string $user
     * @param string $password
     */
    function __construct(string $dns, string $user, string $password)
    {
        $platform = "Mysql";
        $queryBuilder = "\\Bank\\Builder\\Platform\\" . $platform . "\\Builder";

        $this->conn = new Connection($dns, $user, $password);
        $this->queryBuilder = new $queryBuilder($this->conn);
    }

    /**
     * @return ConnectionInterface
     */
    public function getConnection(): ConnectionInterface
    {
        return $this->conn;
    }

    /**
     * @return QueryBuilderInterface
     */
    public function getQueryBuilder(): QueryBuilderInterface
    {
        return $this->queryBuilder;
    }
}