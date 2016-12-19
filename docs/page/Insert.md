### INSERT


### Execution

```
$insert = new Insert("users");
$insert->values(['name' => 'name']);

$adapter->getGateway();
$gateway->insert($insert);
```

### QueryBuilder

```
$insert = new Insert("users");

$insert
->values(['name' => 'name1'])
->values(['name' => 'name2']);

# INSERT INTO `users` (name) VALUES ('name1'),('name2');
```
