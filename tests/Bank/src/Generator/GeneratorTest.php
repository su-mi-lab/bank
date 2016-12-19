<?php

class GeneratorTest extends TestCase
{
    protected function setUp()
    {
        $this->adapter = \Bank\Bank::adapter();
        $this->gateway = $this->adapter->getGateway();
    }

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