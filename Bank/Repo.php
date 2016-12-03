<?php

namespace Bank;

use Bank\Sql\SqlInterface;

/**
 * Class Bank
 * @package Bank
 */
class Bank implements RepoInterface
{

    /**
     * @param AdapterInterface $adapter
     * @param SqlInterface $query
     * @return array
     */
    public static function find(AdapterInterface $adapter, SqlInterface $query): array
    {
        // TODO: Implement find() method.
    }

    /**
     * @param AdapterInterface $adapter
     * @param SqlInterface $query
     * @return array
     */
    public static function findAll(AdapterInterface $adapter, SqlInterface $query): array
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @param AdapterInterface $adapter
     * @param SqlInterface $query
     * @return array
     */
    public static function insert(AdapterInterface $adapter, SqlInterface $query): array
    {
        // TODO: Implement insert() method.
    }

    /**
     * @param AdapterInterface $adapter
     * @param SqlInterface $query
     * @return array
     */
    public static function update(AdapterInterface $adapter, SqlInterface $query): array
    {
        // TODO: Implement update() method.
    }

    /**
     * @param AdapterInterface $adapter
     * @param SqlInterface $query
     * @return array
     */
    public static function delete(AdapterInterface $adapter, SqlInterface $query): array
    {
        // TODO: Implement delete() method.
    }
}