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

    const FROM_TEST_WHERE = "SELECT * FROM `users` WHERE id = '1' AND id != '1' AND id > '1' AND id >= '1' AND id < '1' AND id <= '1' AND id IS NULL AND id LIKE '1%' AND id NOT LIKE '1%' AND id IN ('1' , '2' , '3' , '4') ";
    function testWhere()
    {
        $select = new Select();
        $select->from("users");
        $select->where
            ->equalTo("id", 1)
            ->notEqualTo("id", 1)
            ->greaterThan("id", 1)
            ->greaterThanOrEqualTo("id", 1)
            ->lessThan("id", 1)
            ->lessThanOrEqualTo("id", 1)
            ->isNull("id")
            ->like("id", "1%")
            ->notLike("id", "1%")
            ->include("id", [1, 2, 3, 4]);

        $this->assertEquals(
            static::FROM_TEST_WHERE,
            $this->adapter->getQueryBuilder()->buildSelectQuery($select)
        );
    }
}