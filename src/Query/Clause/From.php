<?php

namespace Bank\Query\Clause;

/**
 * Class From
 * @package Bank\Query\Clause
 */
class From
{
    /**
     * @var array|string
     */
    private $table = null;

    /**
     * @param $table
     */
    public function table($table)
    {
        $this->table = $table;
    }

    /**
     * @return array|string
     */
    public function getTable()
    {
        return $this->table;
    }

}