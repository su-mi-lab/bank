<?php


abstract class Mysql extends TestCase
{
    const FROM_TEST_QUERY = "SELECT * FROM `users`";
    const COLUMN_TEST_QUERY = "SELECT `id`,`name` FROM `users`";
    const ALIAS_TEST_QUERY = "SELECT `u`.`id` AS `users_id` FROM `users` AS `u` WHERE u.id = :b0";
    const WHERE_TEST_QUERY = "SELECT * FROM `users` WHERE id = :b0 AND id != :b1 AND id > :b2 AND id >= :b3 AND id < :b4 AND id <= :b5 AND id IS NULL AND id LIKE :b6 AND id NOT LIKE :b7 AND id IN (:b8 , :b9 , :b10 , :b11)";
    const WHERE_NEST_QUERY1 = "SELECT * FROM `users` WHERE id != :b0 AND (id = :b1 OR id IS NULL)";
    const WHERE_NEST_QUERY2 = "SELECT * FROM `users` WHERE (id = :b0 OR id IS NULL) AND id != :b1";
    const GROUP_TEST_QUERY = "SELECT * FROM `users` GROUP BY 'id'";
    const GROUP_TEST_QUERY2 = "SELECT * FROM `users` AS `u` GROUP BY 'u.id','u.name'";
    const ORDER_TEST_QUERY = "SELECT * FROM `users` AS `u` ORDER BY u.id desc,u.name asc";
    const EXPRESSION_TEST_QUERY = "SELECT COUNT(*) AS `count` FROM `users`";
    const JOIN_TEST_QUERY = "SELECT `u`.`id`,`u2`.`name` FROM `users` AS `u` INNER JOIN `users` AS `u2` ON u.id = u2.id LEFT JOIN `users` AS `u3` ON u.id = u3.id RIGHT JOIN `users` AS `u4` ON u.id = u4.id WHERE u.id = :b0 GROUP BY 'u.id' ORDER BY u.id desc";
    const LIMIT_QUERY = "SELECT * FROM `users` LIMIT 10 OFFSET 0";

    const UPDATE_SIMPLE_QUERY = "UPDATE `users` SET name = 'test' WHERE id = :b0";
    const INSERT_SIMPLE_QUERY = "INSERT INTO `users` (name) VALUES ('name1'),('name2');";
    const DELETE_SIMPLE_QUERY = "DELETE FROM `users` WHERE name LIKE :b0";
}