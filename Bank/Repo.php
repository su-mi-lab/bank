<?php

namespace Bank;

use Bank\Driver\Platform\ConnectionInterface;
use Bank\Sql\SqlInterface;

/**
 * Class Bank
 * @package Bank
 */
class Bank implements RepoInterface
{

    /**
     * @param ConnectionInterface $conn
     * @param SqlInterface $query
     * @return array
     */
    public static function find(ConnectionInterface $conn, SqlInterface $query): array
    {
        // TODO: Implement find() method.
    }

    /**
     * @param ConnectionInterface $conn
     * @param SqlInterface $query
     * @return array
     */
    public static function findAll(ConnectionInterface $conn, SqlInterface $query): array
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @param ConnectionInterface $conn
     * @param SqlInterface $query
     * @return array
     */
    public static function insert(ConnectionInterface $conn, SqlInterface $query): array
    {
        // TODO: Implement insert() method.
    }

    /**
     * @param ConnectionInterface $conn
     * @param SqlInterface $query
     * @return array
     */
    public static function update(ConnectionInterface $conn, SqlInterface $query): array
    {
        // TODO: Implement update() method.
    }

    /**
     * @param ConnectionInterface $conn
     * @param SqlInterface $query
     * @return array
     */
    public static function delete(ConnectionInterface $conn, SqlInterface $query): array
    {
        // TODO: Implement delete() method.
    }
}