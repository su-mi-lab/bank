<?php

namespace Bank;

use Bank\Driver\Platform\DriverInterface;
use Bank\Sql\SqlInterface;

/**
 * Interface AdapterInterface
 * @package Bank
 */
interface AdapterInterface
{
    /**
     * @return DriverInterface
     */
    public function getDriver(): DriverInterface;

    /**
     * @return SqlInterface
     */
    public function getSql(): SqlInterface;

    /**
     * @return string
     */
    public function getPlatform(): string;
}