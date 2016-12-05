<?php

use Bank\Adapter;
use Bank\Query\Select;

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

    const FROM_TEST_QUERY = "SELECT * FROM `users`";
    function testFrom()
    {
        $select = new Select();
        $select->from("users");
        $this->assertEquals(
            static::FROM_TEST_QUERY,
            $this->adapter->getQueryBuilder()->buildSelectQuery($select)
        );
    }

    const FROM_TEST_ALIAS_QUERY = "SELECT * FROM `users` AS `u`";
    function testFromAlias()
    {
        $select = new Select();
        $select->from(["u" => "users"]);

        $this->assertEquals(
            static::FROM_TEST_ALIAS_QUERY,
            $this->adapter->getQueryBuilder()->buildSelectQuery($select)
        );
    }
}