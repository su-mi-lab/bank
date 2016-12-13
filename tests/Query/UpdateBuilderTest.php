<?php

use Bank\Query\Update;

require_once 'Query.php';

class UpdateBuilderTest extends Query
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

        $this->repo->update($update);
    }

}