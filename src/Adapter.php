<?php

namespace Bank;

use Bank\Platform\BuilderInterface;
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
     * @var BuilderInterface
     */
    private $queryBuilder;


    function __construct($dns, $user, $password)
    {
        $platform = "Mysql";
        $conn = "\\Bank\\Platform\\" . $platform . "\\Connection";
        $queryBuilder = "\\Bank\\Platform\\".$platform."\\Builder";
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
     * @return BuilderInterface
     */
    public function getQueryBuilder(): BuilderInterface
    {
        return $this->queryBuilder;
    }
}