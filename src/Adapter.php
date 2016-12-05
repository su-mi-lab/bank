<?php

namespace Bank;

use Bank\Driver\Driver;
use Bank\Driver\DriverInterface;
use Bank\Sql\Sql;
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

    function __construct($dns, $user, $password)
    {
        $this->platform = "Mysql";
        $this->driver = new Driver($this->platform, $dns, $user, $password);
        $this->sql = new Sql($this->platform);
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