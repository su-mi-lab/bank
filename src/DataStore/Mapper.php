<?php

namespace Bank\DataStore;

use Bank\Bank;
use Bank\Query\Delete;
use Bank\Query\Insert;
use Bank\Query\Update;

/**
 * Class Mapper
 * @package Bank\DataStore
 */
class Mapper implements MapperInterface
{
    /**
     * @var RepoInterface
     */
    private $repo;

    /**
     * @var string
     */
    protected $adapterName = Bank::ADAPTER_DEFAULT_NAMESPACE;

    /**
     * @param ModelInterface $model
     * @return int
     */
    public function save(ModelInterface $model): int
    {
        if ($model->getPrimaryKey()) {
            return $this->update($model);
        }

        return $this->insert($model);
    }

    /**
     * @param ModelInterface $model
     * @return int
     */
    public function delete(ModelInterface $model): int
    {
        if (!$model->getPrimaryKey()) {
            return 0;
        }

        $delete = new Delete($model->getTableName());
        $delete->where->equalTo($model->getPrimaryCol(), $model->getPrimaryKey());

        return $this->repo()->delete($delete);
    }

    /**
     * @param ModelInterface $model
     * @return int
     */
    protected function insert(ModelInterface $model): int
    {
        $insert = new Insert($model->getTableName());
        $insert->values($model->getTableRowData());
        return $this->repo()->insert($insert);
    }

    /**
     * @param ModelInterface $model
     * @return int
     */
    protected function update(ModelInterface $model): int
    {
        $update = new Update($model->getTableName());
        $update
            ->set($model->getTableRowData())
            ->where
            ->equalTo($model->getPrimaryCol(), $model->getPrimaryKey());
        return $this->repo()->update($update);
    }

    /**
     * @return RepoInterface
     * @throws \Exception
     */
    protected function repo(): RepoInterface
    {
        if ($this->repo) {
            return $this->repo;
        }

        $adapter = Bank::adapter($this->adapterName);
        $this->repo = $adapter->getRepo();

        return $this->repo;
    }
}