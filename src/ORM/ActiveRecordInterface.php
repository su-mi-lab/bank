<?php

namespace Bank\ORM;

use Bank\DataStore\AdapterInterface;
use Bank\Query\Select;

/**
 * Interface ActiveRecordInterface
 * @package Bank\ORM
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