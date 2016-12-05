<?php

namespace Bank;

use Bank\Platform\BuilderInterface;
use Bank\Platform\ConnectionInterface;

/**
 * Interface AdapterInterface
 * @package Bank
 */
interface AdapterInterface
{

    /**
     * @return ConnectionInterface
     */
    public function getConnection(): ConnectionInterface;

    /**
     * @return BuilderInterface
     */
    public function getQueryBuilder(): BuilderInterface;

}