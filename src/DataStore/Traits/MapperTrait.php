<?php

namespace Bank\DataStore\Traits;

use Bank\DataStore\ModelInterface;
use Bank\DataStore\RepoInterface;
use Bank\Query\Insert;
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
     * @var ModelInterface
     */
    protected $model;

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