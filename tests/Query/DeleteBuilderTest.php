<?php

use Bank\Query\Delete;

require_once 'Query.php';

class DeleteBuilderTest extends Query
{

    function testFromQuery()
    {
        $this->adapter->getConnection()->beginTransaction();

        $delete = new Delete("users");
        $delete->where->like('name', "name%");

        $this->assertEquals(
            static::DELETE_SIMPLE_QUERY,
            $this->adapter->getQueryBuilder()->buildDeleteQuery($delete)
        );

        $this->repo->delete($delete);

        $this->adapter->getConnection()->rollback();
    }

}