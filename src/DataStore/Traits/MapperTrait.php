<?php

namespace Bank\DataStore\Traits;

use Bank\Bank;
use Bank\DataStore\ModelInterface;
use Bank\DataStore\RepoInterface;
use Bank\Query\Delete;
use Bank\Query\Insert;
use Bank\Query\Select;
use Bank\Query\Update;

/**
 * Class MapperTrait
 * @package Bank\DataStore\Traits
 */
trait MapperTrait
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
     * @var ModelInterface
     */
    protected $model;

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

        $delete = new Delete($model::getTableName());
        $delete->where->equalTo($model->getPrimaryCol(), $model->getPrimaryKey());

        return $this->repo()->delete($delete);
    }

    /**
     * @return Select
     */
    public function select(): Select
    {
        $model = $this->model;
        return new Select($model::getTableName());
    }

    /**
     * @param Select $query
     * @return ModelInterface
     */
    public function load(Select $query): ModelInterface
    {
        return $this->repo()->find($query, $this->model);
    }

    /**
     * @param Select $query
     * @return array
     */
    public function loadAll(Select $query): array
    {
        return $this->repo()->findAll($query, $this->model);
    }

    /**
     * @param ModelInterface $model
     * @return int
     */
    protected function insert(ModelInterface $model): int
    {
        $insert = new Insert($model::getTableName());
        $insert->values($model->getTableRowData());
        return $this->repo()->insert($insert);
    }

    /**
     * @param ModelInterface $model
     * @return int
     */
    protected function update(ModelInterface $model): int
    {
        $update = new Update($model::getTableName());
        $update
            ->set($model->getTableRowData())
            ->where
            ->equalTo($model->getPrimaryCol(), $model->getPrimaryKey());
        return $this->repo()->update($update);
    }

    /**
     * @return RepoInterface
     */
    protected function repo(): RepoInterface
    {
        return $this->repo;
    }
}