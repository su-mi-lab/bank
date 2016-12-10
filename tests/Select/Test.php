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
        $this->adapter = new Adapter('mysql:host=localhost;dbname=bank;charset=utf8', 'root', '');
    }

    const FROM_TEST_QUERY = "SELECT * FROM `users`";

    function testFrom()
    {
        $select = new Select("users");
        $this->assertEquals(
            static::FROM_TEST_QUERY,
            $this->adapter->getQueryBuilder()->buildSelectQuery($select)
        );
    }

    const COLUMN_TEST_QUERY = "SELECT `id`,`name` FROM `users`";

    function testColumn()
    {
        $select = new Select("users");
        $select->cols(['id', 'name']);

        $this->assertEquals(
            static::COLUMN_TEST_QUERY,
            $this->adapter->getQueryBuilder()->buildSelectQuery($select)
        );
    }

    const ALIAS_TEST_QUERY = "SELECT `u`.`id` AS `users_id` FROM `users` AS `u` WHERE u.id = '1'";

    function testAlias()
    {
        $select = new Select(["u" => "users"]);
        $select
            ->cols(['users_id' => 'id'], 'u')
            ->where
            ->equalTo(["u" => "id"], 1);

        $this->assertEquals(
            static::ALIAS_TEST_QUERY,
            $this->adapter->getQueryBuilder()->buildSelectQuery($select)
        );
    }

    const WHERE_TEST_QUERY = "SELECT * FROM `users` WHERE id = '1' AND id != '1' AND id > '1' AND id >= '1' AND id < '1' AND id <= '1' AND id IS NULL AND id LIKE '1%' AND id NOT LIKE '1%' AND id IN ('1' , '2' , '3' , '4')";

    function testWhere()
    {
        $select = new Select("users");
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
            static::WHERE_TEST_QUERY,
            $this->adapter->getQueryBuilder()->buildSelectQuery($select)
        );
    }

    const WHERE_NEST_QUERY1 = "SELECT * FROM `users` WHERE id != '1' AND (id = '1' OR id IS NULL)";
    const WHERE_NEST_QUERY2 = "SELECT * FROM `users` WHERE (id = '1' OR id IS NULL) AND id != '1'";

    function testNestWhere()
    {
        $select = new Select("users");
        $select->where
            ->notEqualTo("id", 1)
            ->nest
            ->equalTo("id", 1)
            ->or
            ->isNull("id")
            ->unNest;

        $this->assertEquals(
            static::WHERE_NEST_QUERY1,
            $this->adapter->getQueryBuilder()->buildSelectQuery($select)
        );

        $select = new Select("users");
        $select->where
            ->nest
            ->equalTo("id", 1)
            ->or
            ->isNull("id")
            ->unNest
            ->notEqualTo("id", 1);

        $this->assertEquals(
            static::WHERE_NEST_QUERY2,
            $this->adapter->getQueryBuilder()->buildSelectQuery($select)
        );

    }

    const WHERE_GROUP_QUERY = "SELECT * FROM `users` GROUP BY 'id'";
    const WHERE_GROUP_QUERY2 = "SELECT * FROM `users` AS `u` GROUP BY 'u.id','u.name'";

    function testGroup()
    {
        $select = new Select("users");
        $select->groupBy('id');

        $this->assertEquals(
            static::WHERE_GROUP_QUERY,
            $this->adapter->getQueryBuilder()->buildSelectQuery($select)
        );

        $select = new Select(['u' => "users"]);
        $select->groupBy(['u.id', 'u.name']);

        $this->assertEquals(
            static::WHERE_GROUP_QUERY2,
            $this->adapter->getQueryBuilder()->buildSelectQuery($select)
        );
    }

    const WHERE_ORDER_QUERY = "SELECT * FROM `users` AS `u` ORDER BY u.id desc,u.name asc";

    function testOrder()
    {
        $select = new Select(["u" => "users"]);
        $select->orderBy(['u.id desc', 'u.name asc']);

        $this->assertEquals(
            static::WHERE_ORDER_QUERY,
            $this->adapter->getQueryBuilder()->buildSelectQuery($select)
        );
    }

    const WHERE_EXPRESSION_QUERY = "SELECT COUNT(*) AS `count` FROM `users`";

    function testExpression()
    {
        $select = new Select('users');

        $select->cols(['count' => new \Bank\Query\Predicate\Expression('COUNT(*)')]);

        $this->assertEquals(
            static::WHERE_EXPRESSION_QUERY,
            $this->adapter->getQueryBuilder()->buildSelectQuery($select)
        );
    }
}