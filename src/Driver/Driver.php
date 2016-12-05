<?php

namespace Bank\Driver\Platform;

/**
 * Class Driver
 * @package Bank\Driver\Platform
 */
class Driver implements DriverInterface
{
    /**
     * @var ConnectionInterface;
     */
    private $conn;

    function __construct()
    {
    }

    /**
     * @return ConnectionInterface
     */
    public function getConnection(): ConnectionInterface
    {
        return $this->conn;
    }
}