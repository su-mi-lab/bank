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
        $mapper = new UserMapper($this->adapter);
        $user->name = 'model';
        $result_save = $mapper->save($user);

        $id = $mapper->getConnection()->lastInsertId();
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
        $user = new UserRecord($this->adapter);
        $user->name = 'model';
        $result_save = $user->save();

        $user->name = 'model update';
        $result_update = $user->save();
        $id = $user->id;
        $result_load = $user->loadById($id);
        $result_delete = $result_load->delete();
        $result_delete_load = $user->loadById($id);

        $this->assertEquals($result_save, 1);
        $this->assertEquals($result_update, 1);
        $this->assertEquals((bool)$result_load, true);
        $this->assertEquals($result_delete, 1);
        $this->assertEquals((bool)$result_delete_load, false);
    }
}