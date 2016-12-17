### SELECT

```php
$select = Bank\Query\Select('users')

# SELECT * FROM `users`

$select->cols(['id', 'name']);

# SELECT `id`,`name` FROM `users`

$select = new Bank\Query\Select(["u" => "users"]);
$select->cols(['users_id' => 'id'], 'u')

# SELECT `u`.`id` AS `users_id` FROM `users` AS `u`

$select->where->equalTo("id", 1)
# SELECT * FROM `users` WHERE id = 1

$select->where->notEqualTo("id", 1)
# SELECT * FROM `users` WHERE id != 1

$select->where->greaterThan("id", 1)
# SELECT * FROM `users` WHERE id > 1

$select->where->greaterThanOrEqualTo("id", 1)
# SELECT * FROM `users` WHERE id >= 1

$select->where->lessThan("id", 1)
# SELECT * FROM `users` WHERE id < 1

$select->where->lessThanOrEqualTo("id", 1)
# SELECT * FROM `users` WHERE id <= 1

$select->where->isNull("id")
# SELECT * FROM `users` WHERE id IS NULL

$select->where->isNotNull("id")
# SELECT * FROM `users` WHERE id IS NOT NULL
           
$select->where->like("id", "1%")
# SELECT * FROM `users` WHERE id LIKE '1%'

$select->where->notLike("id", "1%")
# SELECT * FROM `users` WHERE id NOT LIKE '1%'

$select->where->equalIn("id", [1, 2, 3, 4])
# SELECT * FROM `users` WHERE id IN (1,2,3,4)

$select->where->equalTo(["u" => "id"], 1);
# SELECT * FROM `users` WHERE u.id = 1

$select->where
       ->notEqualTo("id", 1)
       ->nest
       ->equalTo("id", 1)
       ->or
       ->isNull("id")
       ->unNest;
# SELECT * FROM `users` WHERE id != 1 AND (id = 1 OR id IS NULL)

$select->cols(['count' => new \Bank\Query\Predicate\Expression('COUNT(*)')]);
# SELECT COUNT(*) AS `count` FROM `users`

```
