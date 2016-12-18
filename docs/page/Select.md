### SELECT


### Execution

```
$select = Bank\Query\Select('users')

$adapter->getGateway();
$gateway->find($select);
$gateway->findAll($select);
```

### QueryBuilder

```
$select = Bank\Query\Select('users')
# SELECT * FROM `users`
```

```
$select = Bank\Query\Select('users')
$select->cols(['id', 'name']);
# SELECT `id`,`name` FROM `users`
```

```
$select = new Bank\Query\Select(["u" => "users"]);
$select->cols(['users_id' => 'id'], 'u')
# SELECT `u`.`id` AS `users_id` FROM `users` AS `u`
```

```
$select = Bank\Query\Select('users')
$select->where->equalTo("id", 1)
# SELECT * FROM `users` WHERE id = 1
```

```
$select = Bank\Query\Select('users')
$select->where->notEqualTo("id", 1)
# SELECT * FROM `users` WHERE id != 1
```

```
$select = Bank\Query\Select('users')
$select->where->greaterThan("id", 1)
# SELECT * FROM `users` WHERE id > 1
```

```
$select = Bank\Query\Select('users')
$select->where->greaterThanOrEqualTo("id", 1)
# SELECT * FROM `users` WHERE id >= 1
```

```
$select = Bank\Query\Select('users')
$select->where->lessThan("id", 1)
# SELECT * FROM `users` WHERE id < 1
```

```
$select = Bank\Query\Select('users')
$select->where->lessThanOrEqualTo("id", 1)
# SELECT * FROM `users` WHERE id <= 1
```

```
$select = Bank\Query\Select('users')
$select->where->isNull("id")
# SELECT * FROM `users` WHERE id IS NULL
```

```
$select = Bank\Query\Select('users')
$select->where->isNotNull("id")
# SELECT * FROM `users` WHERE id IS NOT NULL
```

```
$select = Bank\Query\Select('users')
$select->where->like("id", "1%")
# SELECT * FROM `users` WHERE id LIKE '1%'
```

```
$select = Bank\Query\Select('users')
$select->where->notLike("id", "1%")
# SELECT * FROM `users` WHERE id NOT LIKE '1%'
```

```
$select = Bank\Query\Select('users')
$select->where->equalIn("id", [1, 2, 3, 4])
# SELECT * FROM `users` WHERE id IN (1,2,3,4)
```

```
$select = Bank\Query\Select('users')
$select->where->equalTo(["u" => "id"], 1);
# SELECT * FROM `users` WHERE u.id = 1
```

```
$select = Bank\Query\Select('users')
$select->where
       ->notEqualTo("id", 1)
       ->nest
       ->equalTo("id", 1)
       ->or
       ->isNull("id")
       ->unNest;
# SELECT * FROM `users` WHERE id != 1 AND (id = 1 OR id IS NULL)
```

```
$select = Bank\Query\Select('users')
$select->cols(['count' => new \Bank\Query\Predicate\Expression('COUNT(*)')]);
# SELECT COUNT(*) AS `count` FROM `users`
```

```
$select = new Select(['u' => 'users']);
$select
->innerJoin(['u2' => 'users'], 'u.id = u2.id')
->leftJoin(['u3' => 'users'], 'u.id = u3.id')
->rightJoin(['u4' => 'users'], 'u.id = u4.id')
# SELECT * FROM `users` AS `u` INNER JOIN `users` AS `u2` ON u.id = u2.id LEFT JOIN `users` AS `u3` ON u.id = u3.id RIGHT JOIN `users` AS `u4` ON u.id = u4.id
```

```
$select = new Select("users");
$select->groupBy('id');
# SELECT * FROM `users` GROUP BY 'id'
```

```
$select = new Select(["u" => "users"]);
$select->orderBy(['u.id desc', 'u.name asc']);
# SELECT * FROM `users` AS `u` ORDER BY u.id desc,u.name asc
```

```
$select = new Select('users');
$select
->limit(10)
->offset(0);
# SELECT * FROM `users` LIMIT 10 OFFSET 0 
```

```
$select = new Select('users');
$select
->cols(['id'], 'u')
->innerJoin(['u2' => 'users'], 'u.id = u2.id')
->groupBy(['u.id'])
->orderBy(['u.id desc'])
->where
->equalTo("u.id", 1);

$select
->reset('where')
->reset('column')
->reset('group')
->reset('order')
->reset('join');

#SELECT * FROM `users`
```
