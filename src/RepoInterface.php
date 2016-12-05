<?php

namespace Bank;

use Bank\Driver\Platform\ConnectionInterface;
use Bank\Sql\Query\Delete;
use Bank\Sql\Query\Insert;
use Bank\Sql\Query\Select;
use Bank\Sql\Query\Update;

/**
 * Interface RepoInterface
 * @package Bank
 */
interface RepoInterface
{

    /**
     * @param ConnectionInterface $conn
     * @param Select $query
     * @return array
     */
    public static function find(ConnectionInterface $conn, Select $query): array;

    /**
     * @param ConnectionInterface $conn
     * @param Select $query
     * @return array
     */
    public static function findAll(ConnectionInterface $conn, Select $query): array;

    /**
     * @param ConnectionInterface $conn
     * @param Insert $query
     * @return int
     */
    public static function insert(ConnectionInterface $conn, Insert $query): int;

    /**
     * @param ConnectionInterface $conn
     * @param Update $query
     * @return int
     */
    public static function update(ConnectionInterface $conn, Update $query): int;

    /**
     * @param ConnectionInterface $conn
     * @param Delete $query
     * @return int
     */
    public static function delete(ConnectionInterface $conn, Delete $query): int;

}