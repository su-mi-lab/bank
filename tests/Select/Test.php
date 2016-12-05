<?php

use Bank\Adapter;

class Test extends PHPUnit_Framework_TestCase
{
    /**
     * @var Bank\Adapter
     */
    protected $adapter;

    protected function setUp()
    {
        $this->adapter = new Adapter('mysql:host=localhost;dbname=bank;charset=utf8', 'root', '');;
    }

    function testFrom()
    {
        $select = $this->adapter->getSql()->getSelect();
        $select->from('users');
        $this->assertEquals("SELECT * FROM users", $select->getQuery());
    }
}