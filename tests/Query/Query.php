<?php

use Bank\Adapter;

/**
 * Class Query
 */
abstract class Query extends PHPUnit_Framework_TestCase
{
    /**
     * @var Bank\Adapter
     */
    protected $adapter;

    /**
     * @var \Bank\RepoInterface
     */
    protected $repo;

    protected function setUp()
    {
        $this->adapter = new Adapter('mysql:host=localhost;dbname=bank;charset=utf8', 'root', '');
        $this->repo = new \Bank\Repo($this->adapter);
    }

    const FROM_TEST_QUERY = "SELECT * FROM `users`";
    const COLUMN_TEST_QUERY = "SELECT `id`,`name` FROM `users`";
    const ALIAS_TEST_QUERY = "SELECT `u`.`id` AS `users_id` FROM `users` AS `u` WHERE u.id = '1'";
    const WHERE_TEST_QUERY = "SELECT * FROM `users` WHERE id = '1' AND id != '1' AND id > '1' AND id >= '1' AND id < '1' AND id <= '1' AND id IS NULL AND id LIKE '1%' AND id NOT LIKE '1%' AND id IN ('1' , '2' , '3' , '4')";
    const WHERE_NEST_QUERY1 = "SELECT * FROM `users` WHERE id != '1' AND (id = '1' OR id IS NULL)";
    const WHERE_NEST_QUERY2 = "SELECT * FROM `users` WHERE (id = '1' OR id IS NULL) AND id != '1'";
    const WHERE_GROUP_QUERY = "SELECT * FROM `users` GROUP BY 'id'";
    const WHERE_GROUP_QUERY2 = "SELECT * FROM `users` AS `u` GROUP BY 'u.id','u.name'";
    const WHERE_ORDER_QUERY = "SELECT * FROM `users` AS `u` ORDER BY u.id desc,u.name asc";
    const WHERE_EXPRESSION_QUERY = "SELECT COUNT(*) AS `count` FROM `users`";
}