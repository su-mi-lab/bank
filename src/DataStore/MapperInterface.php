<?php

namespace Bank\DataStore;

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

}