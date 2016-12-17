<?php

require_once 'Query.php';
require_once 'Model/User.php';
require_once 'Model/UserMapper.php';
require_once 'Model/UserRecord.php';

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

//        $this->assertEquals(
//            (bool)$mapper->loadById($id),
//            true
//        );

//        $this->assertEquals(
//            $mapper->delete($user),
//            1
//        );
    }

    function testActiveRecord()
    {
        $user = new UserRecord();
        $user->name = 'model';

        $this->assertEquals(
            $user->save(),
            1
        );

        $user->name = 'model update';

        $this->assertEquals(
            $user->save(),
            1
        );

//        $this->assertEquals(
//            (bool)$user->loadById($user->id),
//            true
//        );

//        $this->assertEquals(
//            $user->delete(),
//            1
//        );
//
//        $this->assertEquals(
//            (bool)$user->loadById($user->id),
//            false
//        );
    }
}