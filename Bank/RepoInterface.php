<?php

namespace Bank;

use Bank\Driver\Platform\ConnectionInterface;
use Bank\Sql\SqlInterface;

/**
 * Interface RepoInterface
 * @package Bank
 */
interface RepoInterface
{

    /**
     * @param ConnectionInterface $conn
     * @param SqlInterface $query
     * @return array
     */
    public static function find(ConnectionInterface $conn, SqlInterface $query): array;

    /**
     * @param ConnectionInterface $conn
     * @param SqlInterface $query
     * @return array
     */
    public static function findAll(ConnectionInterface $conn, SqlInterface $query): array;

    /**
     * @param ConnectionInterface $conn
     * @param SqlInterface $query
     * @return array
     */
    public static function insert(ConnectionInterface $conn, SqlInterface $query): array;

    /**
     * @param ConnectionInterface $conn
     * @param SqlInterface $query
     * @return array
     */
    public static function update(ConnectionInterface $conn, SqlInterface $query): array;

    /**
     * @param ConnectionInterface $conn
     * @param SqlInterface $query
     * @return array
     */
    public static function delete(ConnectionInterface $conn, SqlInterface $query): array;

}