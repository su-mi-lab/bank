<?php

namespace Bank\Query\Clause;

/**
 * Class Where
 * @package Bank\Query
 */
class From
{
    /**
     * @var array|string
     */
    private $table;

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