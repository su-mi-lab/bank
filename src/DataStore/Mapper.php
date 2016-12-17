<?php

namespace Bank\DataStore;

use Bank\Bank;
use Bank\DataStore\Traits\MapperTrait;

/**
 * Class Mapper
 * @package Bank\DataStore
 *
 * @property  string adapterName
 */
abstract class Mapper implements MapperInterface
{
    use MapperTrait;

    /**
     * Mapper constructor.
     */
    public function __construct()
    {
        $adapter = Bank::adapter($this->adapterName);
        $this->repo = $adapter->getRepo();
    }
}