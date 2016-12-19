<?php

use Bank\DataStore\Adapter;

class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var Adapter
     */
    protected $adapter;

    /**
     * @var Bank\DataStore\GatewayInterface
     */
    protected $gateway;

    protected function setUp()
    {
        $this->adapter = \Bank\Bank::adapter();
        $this->gateway = $this->adapter->getGateway();
    }

    protected function tearDown()
    {
        $this->adapter->getConnection()->exec('TRUNCATE TABLE users');
    }
}