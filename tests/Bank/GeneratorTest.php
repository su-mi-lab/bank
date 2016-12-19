<?php

require_once 'Query.php';


class GeneratorTest extends Query
{

    function testSchema()
    {
        $schema = new \Bank\Generator\Schema($this->adapter);
        $schemaDir = \Bank\Bank::getConfig('schema');
        $this->assertEquals(
            true,
            $schema->run($schemaDir)
        );

    }
}