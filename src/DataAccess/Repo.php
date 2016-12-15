<?php

namespace Bank\DataAccess;

use Bank\AdapterInterface;
use Bank\Builder\QueryBuilderInterface;
use Bank\Query\Delete;
use Bank\Query\Insert;
use Bank\Query\Select;
use Bank\Query\Update;

/**
 * Class Repo
 * @package Bank
 */
class Repo implements RepoInterface
{

    /**
     * @var ConnectionInterface
     */
    private $conn;

    /**
     * @var QueryBuilderInterface
     */
    private $builder;

    public function __construct(ConnectionInterface $conn, QueryBuilderInterface $builder)
    {
        $this->conn = $conn;
        $this->builder = $builder;
    }

    /**
     * @param Select $query
     * @return array
     */
    public function find(Select $query): array
    {

        $statement = $this->conn->prepare($this->builder->buildSelectQuery($query), $this->builder->getBindValue());
        $statement->execute();

        $result = $statement->fetch();

        return ($result) ? $result : [];
    }

    /**
     * @param Select $query
     * @return array
     */
    public function findAll(Select $query): array
    {
        $statement = $this->conn->prepare($this->builder->buildSelectQuery($query), $this->builder->getBindValue());
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
}