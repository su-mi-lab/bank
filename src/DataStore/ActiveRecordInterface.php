<?php

namespace Bank\DataStore;

use Bank\Query\Select;

/**
 * Interface ActiveRecordInterface
 * @package Bank\DataStore
 */
interface ActiveRecordInterface
{

    /**
     * @return int
     */
    public function save(): int;

    /**
     * @return int
     */
    public function delete(): int;

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
}