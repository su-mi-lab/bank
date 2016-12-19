<?php

use Bank\Query\Delete;

require_once 'Query.php';

class DeleteBuilderTest extends Query
{

    function testFromQuery()
    {
        $delete = new Delete("users");
        $delete->where->like('name', "name%");

        $this->assertEquals(
            static::DELETE_SIMPLE_QUERY,
            $this->adapter->getQueryBuilder()->buildDeleteQuery($delete)
        );

        $this->gateway->delete($delete);
    }

}