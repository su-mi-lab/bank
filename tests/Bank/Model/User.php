<?php


/**
 * Class User
 * @package Bank\Model
 */
class User extends \Bank\DataStore\Model
{
    protected $tableName = 'users';

    protected $tableSchema = [
        'id',
        'name'
    ];

    protected $primaryKey = 'id';
}