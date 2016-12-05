<?php

namespace Bank;

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
     * @param AdapterInterface $adapter
     * @param Select $query
     * @return array
     */
    public static function find(AdapterInterface $adapter, Select $query): array
    {
    }

    /**
     * @param AdapterInterface $adapter
     * @param Select $query
     * @return array
     */
    public static function findAll(AdapterInterface $adapter, Select $query): array
    {
    }

    /**
     * @param AdapterInterface $adapter
     * @param Insert $query
     * @return int
     */
    public static function insert(AdapterInterface $adapter, Insert $query): int
    {
    }

    /**
     * @param AdapterInterface $adapter
     * @param Update $query
     * @return int
     */
    public static function update(AdapterInterface $adapter, Update $query): int
    {
    }

    /**
     * @param AdapterInterface $adapter
     * @param Delete $query
     * @return int
     */
    public static function delete(AdapterInterface $adapter, Delete $query): int
    {
    }
}