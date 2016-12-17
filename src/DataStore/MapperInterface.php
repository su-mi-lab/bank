<?php

namespace Bank\DataStore;

use Bank\Query\Select;

/**
 * Interface MapperInterface
 * @package Bank\DataStore
 */
interface MapperInterface
{

    /**
     * @param ModelInterface $model
     * @return int
     */
    public function save(ModelInterface $model): int;

    /**
     * @param ModelInterface $model
     * @return int
     */
    public function delete(ModelInterface $model): int;

    /**
     * @param Select $query
     */
    public function load(Select $query);

    /**
     * @return Select
     */
    public function select(): Select;

    /**
     * @param Select $query
     * @return array
     */
    public function loadAll(Select $query): array;

    /**
     * @return ConnectionInterface
     */
    public function getConnection(): ConnectionInterface;
}