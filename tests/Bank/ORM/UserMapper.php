<?php

/**
 * Class UserMapper
 */
class UserMapper extends \Bank\ORM\Mapper
{
    protected $model = User::class;

    /**
     * @param $id
     * @return \Bank\ORM\ModelInterface
     */
    public function loadById($id)
    {
        $select = $this->select();
        $select->where->equalTo('id', $id);
        return $this->load($select);
    }
}