### UPDATE


### Execution

```
$update = new Update("users");
$update
->set(['name' => 'test'])
->where
->equalTo('id', 1);

$adapter->getGateway();
$gateway->update($update);
```

### QueryBuilder

```
$update = new Update("users");
$update
->set(['name' => 'test'])
->where
->equalTo('id', 1);

# UPDATE `users` SET name = 'test' WHERE id = 1
```
