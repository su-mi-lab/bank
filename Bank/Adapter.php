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
     * @return DriverInterface
     */
    public function getDriver(): DriverInterface
    {
        // TODO: Implement getDriver() method.
    }

    /**
     * @return SqlInterface
     */
    public function getSql(): SqlInterface
    {
        // TODO: Implement getSql() method.
    }
}