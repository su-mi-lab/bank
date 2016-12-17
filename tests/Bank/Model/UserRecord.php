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
     * @return \Bank\DataStore\ActiveRecordInterface
     */
    public function loadById($id)
    {
        $select = $this->select();
        $select->where->equalTo('id', $id);
        return $this->load($select);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->loadAll($this->select());
    }
}