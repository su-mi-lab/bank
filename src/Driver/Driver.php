<?php

namespace Bank\Driver;

use Bank\Driver\Platform\ConnectionInterface;

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

    function __construct($platform, $dns, $user, $password)
    {
        $conn = "\\Bank\\Driver\\Platform\\".$platform;
        $this->conn = new $conn($dns, $user, $password);
    }

    /**
     * @return ConnectionInterface
     */
    public function getConnection(): ConnectionInterface
    {
        return $this->conn;
    }
}