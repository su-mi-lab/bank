<?php

require_once 'Query.php';
require_once 'Model/User.php';
require_once 'Model/UserMapper.php';
require_once 'Model/UserRecord.php';

class ModelTest extends Query
{
    function testInsertAndUpdateAndDelete()
    {
        \Bank\Bank::setConfig(include __DIR__ . '/config/bank.php');
        $adapter = \Bank\Bank::adapter();

        $user = new User();
        $mapper = new UserMapper($adapter);
        $user->name = 'model';
        $result_save = $mapper->save($user);

        $id = $this->adapter->getConnection()->lastInsertId();
        $user->id = $id;
        $user->name = 'model update';
        $result_update = $mapper->save($user);

        $result_load = $mapper->loadById($id);
        $result_delete = $mapper->delete($user);
        $result_delete_load = $mapper->loadById($id);

        $this->assertEquals($result_save, 1);
        $this->assertEquals($result_update, 1);
        $this->assertEquals((bool)$result_load, true);
        $this->assertEquals($result_delete, 1);
        $this->assertEquals((bool)$result_delete_load, false);
    }

    function testActiveRecord()
    {
        \Bank\Bank::setConfig(include __DIR__ . '/config/bank.php');
        $adapter = \Bank\Bank::adapter();

        $user = new UserRecord($adapter);
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