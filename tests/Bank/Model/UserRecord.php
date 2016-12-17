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
     * @param $adapter
     * @param $id
     * @return \Bank\DataStore\ActiveRecordInterface|null
     */
    public static function loadById($adapter, $id)
    {
        $select = self::select();
        $select->where->equalTo('id', $id);
        return self::load($adapter, $select);
    }

    /**
     * @return array
     */
    public static function findAll($adapter)
    {
        return self::loadAll($adapter, self::select());
    }
}