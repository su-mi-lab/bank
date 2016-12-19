<?php

namespace Bank\DataStore;

use Bank\Builder\QueryBuilderInterface;
use Bank\Query\Delete;
use Bank\Query\Insert;
use Bank\Query\Select;
use Bank\Query\Update;

/**
 * Class Gateway
 * @package Bank\DataStore
 */
class Gateway implements GatewayInterface
{

    /**
     * @var ConnectionInterface
     */
    private $conn;

    /**
     * @var QueryBuilderInterface
     */
    private $builder;

    /**
     * Gateway constructor.
     * @param ConnectionInterface $conn
     * @param QueryBuilderInterface $builder
     */
    public function __construct(ConnectionInterface $conn, QueryBuilderInterface $builder)
    {
        $this->conn = $conn;
        $this->builder = $builder;
    }

    /**
     * @param Select $query
     * @param string $fetchClass
     * @return array|ModelInterface
     */
    public function find(Select $query, $fetchClass = null)
    {
        $statement = $this->findStatement($query, $fetchClass);
        $statement->execute();
        $result = $statement->fetch();

        return ($result) ? $result : [];
    }

    /**
     * @param Select $query
     * @param string $fetchClass
     * @return array
     */
    public function findAll(Select $query, $fetchClass = null): array
    {
        $statement = $this->findStatement($query, $fetchClass);
        $statement->execute();
        $result = $statement->fetchAll();

        return ($result) ? $result : [];
    }

    /**
     * @param Insert $query
     * @return int
     */
    public function insert(Insert $query): int
    {
        return $this->conn->exec($this->builder->buildInsertQuery($query));
    }

    /**
     * @param Update $query
     * @return int
     */
    public function update(Update $query): int
    {
        $statement = $this->conn->prepare($this->builder->buildUpdateQuery($query), $this->builder->getBindValue());
        $statement->execute();

        return $statement->rowCount();
    }

    /**
     * @param Delete $query
     * @return int
     */
    public function delete(Delete $query): int
    {
        $statement = $this->conn->prepare($this->builder->buildDeleteQuery($query), $this->builder->getBindValue());
        $statement->execute();

        return $statement->rowCount();
    }

    /**
     * @param Select $query
     * @@param string $fetchClass
     * @return \PDOStatement
     */
    private function findStatement(Select $query, $fetchClass = null): \PDOStatement
    {
        $statement = $this->conn->prepare($this->builder->buildSelectQuery($query), $this->builder->getBindValue());
        if ($fetchClass) {
            $statement->setFetchMode(\PDO::FETCH_CLASS, $fetchClass);
        }
        return $statement;
    }
}