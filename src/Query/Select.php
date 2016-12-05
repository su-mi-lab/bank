<?php

namespace Bank\Query;

use Bank\Query\Clause\From;
use Bank\Query\Clause\Where;

/**
 * Class Select
 * @package Bank\Query
 */
class Select
{

    /**
     * @var From
     */
    private $from;

    /**
     * @var Where
     */
    public $where;

    function __construct()
    {
        $this->where = new Where;
        $this->from = new From;
    }

    /**
     * @param $table
     * @return Select
     */
    public function from($table): Select
    {
        $this->from->table($table);
        return $this;
    }

    /**
     * @return From
     */
    public function getFrom(): From
    {
        return $this->from;
    }

    /**
     * @return Where
     */
    public function getWhere(): Where
    {
        return $this->where;
    }

}