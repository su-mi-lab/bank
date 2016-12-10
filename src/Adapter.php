<?php

namespace Bank;

use Bank\Platform\QueryBuilderInterface;
use Bank\Platform\ConnectionInterface;

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
        $conn = "\\Bank\\Platform\\" . $platform . "\\Connection";
        $queryBuilder = "\\Bank\\Platform\\" . $platform . "\\Builder";

        $this->conn = new $conn($dns, $user, $password);
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