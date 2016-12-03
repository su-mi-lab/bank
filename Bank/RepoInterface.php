<?php

namespace Bank;

use Bank\Sql\SqlInterface;

/**
 * Interface RepoInterface
 * @package Bank
 */
interface RepoInterface
{

    /**
     * @param AdapterInterface $adapter
     * @param SqlInterface $query
     * @return array
     */
    public static function find(AdapterInterface $adapter, SqlInterface $query): array;

    /**
     * @param AdapterInterface $adapter
     * @param SqlInterface $query
     * @return array
     */
    public static function findAll(AdapterInterface $adapter, SqlInterface $query): array;

    /**
     * @param AdapterInterface $adapter
     * @param SqlInterface $query
     * @return array
     */
    public static function insert(AdapterInterface $adapter, SqlInterface $query): array;

    /**
     * @param AdapterInterface $adapter
     * @param SqlInterface $query
     * @return array
     */
    public static function update(AdapterInterface $adapter, SqlInterface $query): array;

    /**
     * @param AdapterInterface $adapter
     * @param SqlInterface $query
     * @return array
     */
    public static function delete(AdapterInterface $adapter, SqlInterface $query): array;

}