<?php

use Bank\Query\Insert;
use Bank\Query\Select;
use Bank\Query\Update;
use Bank\Query\Delete;

require_once 'Query.php';

/**
 * Class SimpleQueryTest
 */
class SimpleQueryTest extends Query
{

    const USER_NAME = 'query test user';
    const USER_NAME_UPDATE = 'query test user update';

    function testQuery()
    {
        $this->assertEquals(
            $this->insertUser(),
            1
        );

        $id = $this->lastInsertId();

        $this->assertEquals(
            ['id' => $id, 'name' => self::USER_NAME],
            $this->getUser($id)
        );

        $this->assertEquals(
            $this->updateUser($id),
            1
        );

        $this->assertEquals(
            ['id' => $id, 'name' => self::USER_NAME_UPDATE],
            $this->getUser($id)
        );

        $this->assertEquals(
            $this->deleteUser($id),
            1
        );

        $this->assertEquals(
            [],
            $this->getUser($id)
        );
    }

    /**
     * @return int
     */
    private function insertUser()
    {
        $insert = new Insert("users");
        $insert
            ->values(['name' => self::USER_NAME]);

        return $this->gateway->insert($insert);
    }

    /**
     * @param $id
     * @return int
     */
    private function updateUser($id)
    {
        $update = new Update('users');

        $update->set(['name' => self::USER_NAME_UPDATE])
            ->where
            ->equalTo('id', $id);

        return $this->gateway->update($update);
    }

    /**
     * @param $id
     * @return int
     */
    private function deleteUser($id)
    {
        $delete = new Delete("users");
        $delete->where->equalTo('id', $id);

        return $this->gateway->delete($delete);
    }

    /**
     * @param $id
     * @return array
     */
    private function getUser($id)
    {
        $select = new Select("users");
        $select->where->equalTo('id', $id);
        return $this->gateway->find($select);
    }

    /**
     * @return int
     */
    private function lastInsertId()
    {
        return $this->adapter->getConnection()->lastInsertId();
    }

}