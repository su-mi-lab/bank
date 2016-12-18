<?php

namespace Bank\DataStore;

use Bank\Builder\QueryBuilderInterface;

/**
 * Class Adapter
 * @package Bank\DataStore
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
     * @var GatewayInterface
     */
    private $gateway;

    /**
     * Adapter constructor.
     * @param string $dns
     * @param string $user
     * @param string $password
     */
    function __construct(string $dns, string $user, string $password)
    {
        switch ($dns) {
            default:
                $platform = "Mysql";
                break;
        }

        $queryBuilder = "\\Bank\\Builder\\Platform\\" . $platform . "\\Builder";

        $this->conn = new Connection($dns, $user, $password);
        $this->queryBuilder = new $queryBuilder($this->conn);
        $this->gateway = new Gateway($this->conn, $this->queryBuilder);
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

    /**
     * @return GatewayInterface
     */
    public function getGateway(): GatewayInterface
    {
        return $this->gateway;
    }
}