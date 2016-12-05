<?php

namespace Bank\Driver;

use Bank\Driver\Platform\ConnectionInterface;

/**
 * Interface DriverInterface
 * @package Bank\Driver\Platform
 */
interface DriverInterface
{
    /**
     * @return ConnectionInterface
     */
    public function getConnection(): ConnectionInterface;
}