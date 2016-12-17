### DELETE


### Execution

```
$delete = new Delete("users");
$delete->where->equalTo('id', 1);

$adapter->getRepo();
$repo->delete($delete);
```

### QueryBuilder

```
$delete = new Delete("users");
$delete->where->equalTo('id', 1);

# DELETE FROM `users` WHERE WHERE id = 1
```
