### DataMapper OR ActiveRecord

Create Schema file

File name is the name of the table
`schema/users.php`

```
<?php

return [
    'primary_key' => 'id',
    'record' => ['id', 'name']
];

```

#### Use DataMapper

Create Model file

`Modle\User.php`

```
<?php

/**
 * Class User
 */
class User extends \Bank\DataStore\Model
{
    /**
     * @var string
     */
    protected static $tableName = 'users';
    
    /**
     * @param $id
     * @return \Bank\DataStore\ModelInterface
     */
    public function loadById($id)
    {
        $select = $this->select();
        $select->where->equalTo('id', $id);
        return $this->load($select);
    }
}

```

Create DataMapper file
`Mapper\UserMapper.php`

```
<?php

/**
 * Class UserMapper
 */
class UserMapper extends \Bank\DataStore\Mapper
{
    protected $model = User::class;
}
```

Insert 

```
$user = new User();
$mapper = new UserMapper($adapter);
$user->name = 'model';
$mapper->save($user);
```

Find

```
$mapper = new UserMapper($adapter);
$user = $mapper->loadById($id);
```

Update OR Delete

```
$user = $mapper->loadById($id);
$user->name = 'update';

$mapper->save($user);
$mapper->delete($user);

```

#### Use ActiveRecord

Create Model file

`Modle\User.php`

```
<?php

/**
 * Class User
 */
class User extends \Bank\DataStore\ActiveRecord
{
    /**
     * @var string
     */
    protected static $tableName = 'users';

    /**
     * @param $id
     * @return \Bank\DataStore\ActiveRecordInterface
     */
    public function loadById($id)
    {
        $select = $this->select();
        $select->where->equalTo('id', $id);
        return $this->load($select);
    }
}

```

Insert 

```
$user = new User($adapter);
$user->name = 'model';
$user->save();
```

Find

```
$user = new User($adapter);
$user->loadById($id);
```

Update OR Delete

```
$user = $user->loadById($id);;
$user->name = 'update';

$user->save();
$user->delete();
```
