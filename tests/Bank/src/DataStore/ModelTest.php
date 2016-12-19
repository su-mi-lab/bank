<?php


class ModelTest extends TestCase
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

}