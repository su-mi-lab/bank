<?php

namespace Bank;

use Bank\Driver\Platform\DriverInterface;
use Bank\Sql\SqlInterface;

/**
 * Class Adapter
 * @package Bank
 */
class Adapter implements AdapterInterface
{

    /**
     * @var string
     */
    private $platform;

    /**
     * @var DriverInterface
     */
    private $driver;

    /**
     * @var SqlInterface
     */
    private $sql;

    function __construct()
    {
    }

    /**
     * @return DriverInterface
     */
    public function getDriver(): DriverInterface
    {
        return $this->driver;
    }

    /**
     * @return SqlInterface
     */
    public function getSql(): SqlInterface
    {
        return $this->sql;
    }

    /**
     * @return string
     */
    public function getPlatform(): string
    {
        return $this->platform;
    }
}