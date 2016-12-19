<?php

namespace Bank\ORM\Traits;

use Bank\DataStore\AdapterInterface;
use Bank\DataStore\ConnectionInterface;
use Bank\DataStore\GatewayInterface;
use Bank\ORM\ModelInterface;
use Bank\Query\Insert;
use Bank\Query\Update;

/**
 * Class MapperTrait
 * @package Bank\ORM\Traits
 */
trait MapperTrait
{
    /**
     * @var GatewayInterface
     */
    private $gateway;

    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @return ConnectionInterface
     */
    public function getConnection(): ConnectionInterface
    {
        return $this->adapter->getConnection();
    }

    /**
     * @param ModelInterface $model
     * @return int
     */
    protected function insert(ModelInterface $model): int
    {
        $insert = new Insert($model::getTableName());
        $insert->values($model->getTableRowData());
        return $this->gateway()->insert($insert);
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
        return $this->gateway()->update($update);
    }

    /**
     * @return GatewayInterface
     */
    protected function gateway(): GatewayInterface
    {
        return $this->gateway;
    }
}