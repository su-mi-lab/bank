<?php

namespace Bank\DataStore;

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
     * @param AdapterInterface|null $adapter
     */
    public function __construct(AdapterInterface $adapter = null)
    {
        if ($adapter) {
            $this->injectionAdapter($adapter);
        }
        self::injectionSchema();
    }

    /**
     * @throws \Exception
     */
    public function injectionAdapter(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        $this->repo = $this->adapter->getRepo();

        return $this;
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
        $lastInsertId = $this->getConnection()->lastInsertId();
        $this->{$this->getPrimaryCol()} = $lastInsertId;

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
    public static function select(): Select
    {
        return new Select(static::getTableName());
    }

    /**
     * @param AdapterInterface $adapter
     * @param Select $query
     * @return null|ActiveRecordInterface
     */
    public static function load(AdapterInterface $adapter, Select $query)
    {
        /** @var ActiveRecordInterface $result */
        $result = $adapter->getRepo()->find($query, static::class);

        if ($result) {
            $result->injectionAdapter($adapter);
        }

        return $result;
    }

    /**
     * @param AdapterInterface $adapter
     * @param Select $query
     * @return array
     */
    public static function loadAll(AdapterInterface $adapter, Select $query): array
    {
        $result = $adapter->getRepo()->findAll($query, static::class);

        if ($result) {
            $result = array_map(function ($model) use ($adapter) {
                /** @var ActiveRecordInterface $model */
                return $model->injectionAdapter($adapter);
            }, $result);
        }

        return $result;
    }
}