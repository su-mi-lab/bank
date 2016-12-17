<?php

namespace Bank\Query\Predicate;

/**
 * Class From
 * @package Bank\Query\Predicate
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