## Repo

```php
$repo = $adapter->getRepo();
```

interface

```
/**
 * @param Select $query
 * @param string $fetchClass
 * @return array|ModelInterface
 */
public function find(Select $query, $fetchClass = null);

/**
 * @param Select $query
 * @param string $fetchClass
 * @return array
 */
public function findAll(Select $query, $fetchClass = null): array

/**
 * @param Insert $query
 * @return int
 */
public function insert(Insert $query): int;

/**
 * @param Update $query
 * @return int
 */
public function update(Update $query): int;

/**
 * @param Delete $query
 * @return int
 */
public function delete(Delete $query): int;

```
