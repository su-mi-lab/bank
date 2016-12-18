<?php

use Bank\Query\Insert;

require_once 'Query.php';

class InsertBuilderTest extends Query
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