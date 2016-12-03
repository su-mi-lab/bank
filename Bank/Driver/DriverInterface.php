<?php

namespace Bank\Driver\Platform;

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