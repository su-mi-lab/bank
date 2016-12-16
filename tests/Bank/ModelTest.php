<?php

require_once 'Query.php';
require_once 'Model/User.php';
require_once 'Model/UserMapper.php';

class ModelTest extends Query
{
    function testInsertAndUpdateAndDelete()
    {
        $user = new User();
        $mapper = new UserMapper();

        $user->name = 'model';

        $this->assertEquals(
            $mapper->save($user),
            1
        );

        $id = $this->adapter->getConnection()->lastInsertId();
        $user->id = $id;
        $user->name = 'model update';

        $this->assertEquals(
            $mapper->save($user),
            1
        );

        $this->assertEquals(
            $mapper->delete($user),
            1
        );
    }

}