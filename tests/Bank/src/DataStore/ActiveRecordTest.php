<?php


class ActiveRecordTest extends TestCase
{

    function testActiveRecord()
    {
        $user = new UserRecord($this->adapter);
        $user->name = 'model';
        $result_save = $user->save();

        $user->name = 'model update';
        $result_update = $user->save();
        $id = $user->id;
        $result_load = UserRecord::loadById($this->adapter, $id);
        $result_delete = $result_load->delete();
        $result_delete_load = UserRecord::loadById($this->adapter, $id);

        UserRecord::findAll($this->adapter);

        $this->assertEquals($result_save, 1);
        $this->assertEquals($result_update, 1);
        $this->assertEquals((bool)$result_load, true);
        $this->assertEquals($result_delete, 1);
        $this->assertEquals((bool)$result_delete_load, false);
    }
}