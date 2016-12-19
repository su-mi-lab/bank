<?php

use Bank\Query\Insert;

class InsertBuilderTest extends Mysql
{

    function testFromQuery()
    {
        $insert = new Insert("users");

        $insert
            ->values(['name' => 'name1'])
            ->values(['name' => 'name2']);

        $this->assertEquals(
            static::INSERT_SIMPLE_QUERY,
            $this->adapter->getQueryBuilder()->buildInsertQuery($insert)
        );

        $this->gateway->insert($insert);
    }

}