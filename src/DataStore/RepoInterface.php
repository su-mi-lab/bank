<?php

namespace Bank\DataStore;

use Bank\Query\Delete;
use Bank\Query\Insert;
use Bank\Query\Select;
use Bank\Query\Update;

/**
 * Interface RepoInterface
 * @package Bank\DataStore
 */
interface RepoInterface
{

    /**
     * @param Select $query
     * @return array
     */
    public function find(Select $query): array;

    /**
     * @param Select $query
     * @return array
     */
    public function findAll(Select $query): array;

    /**
     * @param Insert $query
     * @return int
     */
    public function insert(Insert $query): int;

    /**
     * @param Update $query
     * @return int
     */
    public function update(Update $query): int;

    /**
     * @param Delete $query
     * @return int
     */
    public function delete(Delete $query): int;


}