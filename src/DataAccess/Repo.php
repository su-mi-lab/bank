<?php

namespace Bank\DataAccess;

use Bank\AdapterInterface;
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
     * @var AdapterInterface
     */
    private $adapter;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param Select $query
     * @return array
     */
    public function find(Select $query): array
    {
        $connection = $this->adapter->getConnection();
        $builder = $this->adapter->getQueryBuilder();

        /** @var \PDOStatement $statement */
        $statement = $connection->query($builder->buildSelectQuery($query));
        $result = $statement->fetch();

        return ($result) ? $result : [];
    }

    /**
     * @param Select $query
     * @return array
     */
    public function findAll(Select $query): array
    {
        $connection = $this->adapter->getConnection();
        $builder = $this->adapter->getQueryBuilder();

        /** @var \PDOStatement $statement */
        $statement = $connection->query($builder->buildSelectQuery($query));

        if (!$statement) {
            return [];
        }

        return $statement->fetchAll();
    }

    /**
     * @param Insert $query
     * @return int
     */
    public function insert(Insert $query): int
    {
        $connection = $this->adapter->getConnection();
        $builder = $this->adapter->getQueryBuilder();
        return $connection->exec($builder->buildInsertQuery($query));
    }

    /**
     * @param Update $query
     * @return int
     */
    public function update(Update $query): int
    {
        $connection = $this->adapter->getConnection();
        $builder = $this->adapter->getQueryBuilder();
        return $connection->exec($builder->buildUpdateQuery($query));
    }

    /**
     * @param Delete $query
     * @return int
     */
    public function delete(Delete $query): int
    {
        $connection = $this->adapter->getConnection();
        $builder = $this->adapter->getQueryBuilder();
        return $connection->exec($builder->buildDeleteQuery($query));
    }

    /**
     * @return AdapterInterface
     */
    public function getAdapter(): AdapterInterface
    {
        return $this->adapter;
    }
}