<?php

use Bank\Query\Update;

class UpdateBuilderTest extends Mysql
{

    function testFromQuery()
    {
        $update = new Update("users");

        $update
            ->set(['name' => 'test'])
            ->where
            ->equalTo('id', 1);

        $this->assertEquals(
            static::UPDATE_SIMPLE_QUERY,
            $this->adapter->getQueryBuilder()->buildUpdateQuery($update)
        );

        $this->gateway->update($update);
    }

}