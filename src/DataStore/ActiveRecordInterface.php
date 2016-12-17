<?php

namespace Bank\DataStore;

use Bank\DataStore\Traits\ModelTrait;
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
     * @return Select
     */
    public static function select(): Select;

    /**
     * @param AdapterInterface $adapter
     * @param Select $query
     * @return null|ActiveRecordInterface
     */
    public static function load(AdapterInterface $adapter, Select $query);

    /**
     * @param AdapterInterface $adapter
     * @param Select $query
     * @return array
     */
    public static function loadAll(AdapterInterface $adapter, Select $query): array;

    /**
     * @throws \Exception
     */
    public function injectionAdapter(AdapterInterface $adapter);
}