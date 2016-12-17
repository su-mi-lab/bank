<?php

/**
 * Class UserRecord
 */
class UserRecord extends \Bank\DataStore\ActiveRecord
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