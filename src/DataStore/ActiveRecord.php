<?php

namespace Bank\DataStore;

use Bank\Bank;
use Bank\DataStore\Traits\MapperTrait;
use Bank\DataStore\Traits\ModelTrait;
use Bank\Query\Delete;
use Bank\Query\Select;

/**
 * Class ActiveRecord
 * @package Bank\DataStore
 */
abstract class ActiveRecord implements ActiveRecordInterface, ModelInterface
{
    use MapperTrait, ModelTrait;

    /**
     * ActiveRecord constructor.
     */
    public function __construct()
    {
        $adapter = Bank::adapter($this->adapterName);
        $this->repo = $adapter->getRepo();
        self::injectionSchema();
    }

    /**
     * @return int
     */
    public function save(): int
    {
        if ($this->getPrimaryKey()) {
            return $this->update($this);
        }

        $res = $this->insert($this);
        $id = $adapter = Bank::adapter($this->adapterName)->getConnection()->lastInsertId();
        $this->{$this->getPrimaryCol()} = $id;

        return $res;
    }

    /**
     * @return int
     */
    public function delete(): int
    {
        if (!$this->getPrimaryKey()) {
            return 0;
        }

        $delete = new Delete($this::getTableName());
        $delete->where->equalTo($this->getPrimaryCol(), $this->getPrimaryKey());

        return $this->repo()->delete($delete);
    }

    /**
     * @return Select
     */
    public function select(): Select
    {
        return new Select($this::getTableName());
    }

    /**
     * @param Select $query
     * @return ModelInterface
     */
    public function load(Select $query)
    {
        return $this->repo()->find($query, static::class);
    }

    /**
     * @param Select $query
     * @return array
     */
    public function loadAll(Select $query): array
    {
        return $this->repo()->findAll($query, static::class);
    }

}