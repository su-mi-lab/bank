<?php

use Bank\Query\Select;

require_once 'Query.php';

class SelectBuilderTest extends Query
{

    function testFromQuery()
    {
        $select = new Select("users");
        $this->assertEquals(
            static::FROM_TEST_QUERY,
            $this->adapter->getQueryBuilder()->buildSelectQuery($select)
        );

    }

    function testColumnQuery()
    {
        $select = new Select("users");
        $select->cols(['id', 'name']);

        $this->assertEquals(
            static::COLUMN_TEST_QUERY,
            $this->adapter->getQueryBuilder()->buildSelectQuery($select)
        );
    }

    function testAliasQuery()
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

    function testWhereQuery()
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

    function testNestWhereQuery()
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

    function testGroupQuery()
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

    function testOrderQuery()
    {
        $select = new Select(["u" => "users"]);
        $select->orderBy(['u.id desc', 'u.name asc']);

        $this->assertEquals(
            static::WHERE_ORDER_QUERY,
            $this->adapter->getQueryBuilder()->buildSelectQuery($select)
        );
    }

    function testExpressionQuery()
    {
        $select = new Select('users');

        $select->cols(['count' => new \Bank\Query\Predicate\Expression('COUNT(*)')]);

        $this->assertEquals(
            static::WHERE_EXPRESSION_QUERY,
            $this->adapter->getQueryBuilder()->buildSelectQuery($select)
        );
    }
}